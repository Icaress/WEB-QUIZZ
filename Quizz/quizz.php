<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');

require "../Configuration/config.php";

$utilisateur_id = $_SESSION["id"];


// Ici, création d'une nouvelle tentative
if(isset($_GET["catégorie"]) && !isset($_GET["section"])){ 
    $catégorie = $_GET["catégorie"];
    
    $date = (new DateTime())->format('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO tentatives(utilisateur_id, date) VALUES (?,?)");
    $stmt->execute([$utilisateur_id, $date]);

    // On récupère directement l'ID généré (le dernier)
    $tentative_id = $db->lastInsertId();

} 

// On envoie un $_GET["date"] par le header de post en dessous (juse après ce else if) et on reprend tentative_id 
// ça vérifie aussi si la tentative est finie ou si elle est en cours
else if (isset($_GET["date"])) {
    $date = $_GET["date"];

    $stmt = $db->prepare("SELECT id, score 
                                FROM tentatives
                                WHERE date = ? AND utilisateur_id = ?");
    $stmt->execute([$date,$utilisateur_id]);
    $tentative = $stmt->fetch(PDO::FETCH_ASSOC);

    $tentative_id = $tentative["id"];

    // utilisation du score pour empêcher un user de modifier ses réponses sur une ancienne tentative
    if(!empty($tentative["score"])){
        echo "Cette tentative est déjà terminée";
        exit();
    }

}

// remplissage des réponses pas section
// envoie des : tentative_id, question_id, reponse_utilisateur, correcte(bonne réponse)
if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["end"]) ) { 
    $tentative_id = $_POST["tentative_id"];
    $question_id = $_POST["question_id"];
    $reponse_utilisateur = $_POST["reponse"];
    $correcte = $_POST["correcte"];
    $date = $_POST["date"];

    $next_section = $_POST["next_section"];

    if($next_section=="11"){ // affichage de la section "terminer" après avoir répondu à la 10e question
        $next_section = "terminer";
    }

    // vérification si la réponse existe déjà ou non
    $reponse_db_tmp = $db->prepare("SELECT reponse_utilisateur
                                FROM reponses
                                WHERE tentative_id = ? AND question_id = ? ");
    $reponse_db_tmp->execute([$tentative_id, $question_id]);
    $reponse_db = $reponse_db_tmp->fetch();

    //si une réponse existe, on update
    if($reponse_db){
        $stmt = $db->prepare("UPDATE reponses 
                            SET reponse_utilisateur = ? 
                            WHERE tentative_id = ? AND question_id = ? ");
        $stmt->execute([$reponse_utilisateur, $tentative_id, $question_id]);
    } 
    // Si non, on insert une réponse en bdd
    else {
        $stmt = $db->prepare("INSERT INTO reponses(tentative_id, question_id, reponse_utilisateur, correcte)
                            VALUES (?,?,?,?) ");
        $stmt->execute([$tentative_id, $question_id, $reponse_utilisateur, $correcte]);
    }
 

    // On protège la date pour qu'elle passe sans encombre dans l'URL
    header("Location: quizz.php?date=" . urlencode($date) . "&section=" . $next_section);
    exit();
}

// Fin du quizz
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["end"])) { 

    
    // prise des infos nécessaires au calcul du score
    $stmt = $db->prepare("SELECT reponse_utilisateur, correcte
                            FROM reponses 
                            WHERE tentative_id = ?");
    $stmt->execute([$tentative_id]);
    $reponses = $stmt->fetchAll();

    // calcul du score et insertion en bdd
    $score=0;
    foreach ($reponses as $reponse) {
        if($reponse["reponse_utilisateur"] == $reponse["correcte"]){
            $score++;
        }
    }

    $stmt = $db->prepare("UPDATE tentatives set score = ? where id = ?");
    $stmt->execute([$score, $tentative_id]);

    // nettoyage de la table questions_en_cours
    $stmt = $db->prepare("DELETE FROM questions_en_cours WHERE tentative_id = ?");
    $stmt->execute([$tentative_id]);

    // header vers la page des résultats
    header("Location: ../Résultat/Résultat.php?tentative_id=$tentative_id"); 
    exit();
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QUIZZ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src='../Fonction/show.js'></script>
    <?php //<script src="../Fonction/anticheat.js" defer></script> ?>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="quizz.css">
</head>

<body>
    
    <?php // affiche les boutons 1 à 10 où on affiche une section ?>
    
    <div id="wrapper">
        <div id='conteneur'>
            <?php for($q = 1; $q <= 10; $q++) { ?>
                <button onclick="show('<?= $q ?>')" class="nbr btn"><?= $q ?></button>
            <?php } ?> 
            <button onclick="show('terminer')" class="terminer btn">Terminer</button>
        </div>  
    </div>
    <?php
    // vérifier dans questions en cours s'il y a un contenu pour la tentative
    // s'il n'y en a pas, prendre 10 au hasard 
    // s'il y en a, prendre questions-réponses depuis table question where id = id_1, id_2, ... 

    $questions_tmp = $db->prepare("SELECT questions_en_cours.*
                                FROM questions_en_cours, tentatives
                                WHERE tentatives.id = questions_en_cours.tentative_id
                                AND tentatives.date = ? 
                                AND tentatives.utilisateur_id = ?");
    $questions_tmp->execute([$date, $utilisateur_id]);

    // Si les questions sont déjà définies, donc, cas de rechargement de page
    if($questions_tmp->rowCount() > 0){
        $row = $questions_tmp->fetch();
        for($n=1 ; $n <= 10 ; $n++) {
            $questions_id["$n"] = $row["id_{$n}"];
        }

        $placeholders = implode(',', array_fill(0, 10, '?'));
        //$placeholders devient un genre de "?,?,?,?,?,?,?,?,?,?" qui est unse chaîne de caractère (ou string jsp)
        // contraire de explode que je voulaid faire entrer

        $questions_fetch = $db->prepare("SELECT * FROM questions 
                                        WHERE id 
                                        IN ($placeholders) 
                                        ORDER BY FIELD(id, $placeholders)"); // là, il est utilisé

        $params = array_values($questions_id);

        $questions_fetch->execute(array_merge($params, $params));

        $questions = $questions_fetch->fetchAll(); // j'ai du trouver un nom pour celui qui se fait fetchAll, pour avoir au final $questions et faire fonctionner foreach
        // array_values permet de s'assurer qu'on envoie juste les IDs au format liste
        // en gros, on est sûr d'envoyer les valeurs du tableau en ignorant les clés
        // array_merge, c'est pour merge lol

    } 
    // Ici, prise des questions aléatoirement depuis la BDD
    else if ($questions_tmp->rowCount() == 0) {

        $questions_fetch = $db->prepare("SELECT * FROM questions WHERE catégorie = ? ORDER BY RAND() LIMIT 10");
        $questions_fetch->execute([$catégorie]);
        
        $questions = $questions_fetch->fetchAll();
        $questions_id = [];

        for($n = 0 ; $n<10 ; $n++) {
            $questions_id[$n] = $questions[$n]["id"];
        }

        $insertion_qec = $db->prepare("INSERT INTO questions_en_cours(tentative_id, id_1, id_2, id_3, id_4, id_5, id_6, id_7, id_8, id_9, id_10) values (?,?,?,?,?,?,?,?,?,?,?)");
        
        $params = array_merge([$tentative_id], $questions_id);

        $insertion_qec->execute($params);
        // envoie dans la table "questions_en_cours" la tentative_id et faire une boucle pour envoyer toutes les id des questions

    }
    
    $q = 1;

    ?>

    <?php 
    foreach ($questions as $row_question) { ?>
        <section class="section" id="<?= $q ?>">

            <form action="" method="post">

                <p id='title'><?= htmlspecialchars($row_question["question"]) ?></p>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="1" id="<?=$q?>1">
                        <label for="<?=$q?>1">A) <?= htmlspecialchars($row_question["reponse1"]) ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="2" id="<?=$q?>2">
                        <label for="<?=$q?>2">B) <?= htmlspecialchars($row_question["reponse2"]) ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="3" id="<?=$q?>3">
                        <label for="<?=$q?>3">C) <?= htmlspecialchars($row_question["reponse3"]) ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="4" id="<?=$q?>4">
                        <label for="<?=$q?>4">D) <?= htmlspecialchars($row_question["reponse4"]) ?></label>
                    </p>
                </div>

                <input type="hidden" name="tentative_id" value="<?= $tentative_id ?>">
                <input type="hidden" name="question_id" value="<?= $row_question["id"] ?>">
                <input type="hidden" name="correcte" value="<?= $row_question["bonne_reponse"] ?>">
                <input type="hidden" name="date" value="<?= $date ?>">
                <input type="hidden" name="next_section" value="<?= $q+1 ?>">

                <button type="submit">Répondre</button>

            </form>

        </section>
        
    <?php $q++;

    } 
    
    ?>

    <section class="section" id="terminer">
        <form action="" method="post">
            <h2>Tu as répondu à toutes les questions ! 🎉</h2>
            <p>Vérifie bien tes réponses avant de valider, tu ne pourras plus les modifier.</p>
            <input type="hidden" name="end" value="yes">
            <input type="hidden" name="tentative_id" value="<?= $tentative_id ?>">

            <button type="submit">Terminer le quizz</button>
        </form>
    </section>

    <?php // ajouter une variable qui active un show (suivant la dernière réponse remplie) 
    
    if(isset($_GET["section"])){ 
        $section = $_GET['section']; ?>

        <script>show("<?php echo $section; ?>");</script>
        
    <?php } else {?>

        <script>show('1')</script>
    
    <?php } ?>

</body>

</html>