<?php 

session_start();
date_default_timezone_set('Europe/Paris');

// ajouter une condition qui confirme le début du quizz

require "../Configuration/config.php";

$utilisateur_id = $_SESSION["id"];

if(isset($_GET["catégorie"]) && !isset($_GET["section"])){ // faire une condition que l'utiisateur reçois dans le header pour ne pas 
                        // recréer une tentative et utiliser la présente lors d'une recharge accidentelle de la page
                        // ne reçois pas de section à afficher
    $catégorie = $_GET["catégorie"];
    
    $date = (new DateTime())->format('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO tentatives(utilisateur_id, date) VALUES (?,?)");
    $stmt->execute([$utilisateur_id, $date]);

    // On récupère directement l'ID généré (le dernier)
    $tentative_id = $db->lastInsertId();

} else if (isset($_GET["date"])) { // ceci get une variable qui affirme que la tentative n'est pas terminée
                                        // le score n'est pas encore défini

    // On envoie un $_GET["date"] par le header de post et on prend tentative_id
    $date = $_GET["date"];

    $stmt = $db->prepare("SELECT id, score 
                                FROM tentatives
                                WHERE date = ? AND utilisateur_id = ?");
    $stmt->execute([$date,$utilisateur_id]);
    $tentative = $stmt->fetch(PDO::FETCH_ASSOC);

    $tentative_id = $tentative["id"];

    // J'utilise le score pour empêcher un user de modifier ses réponses sur une ancienne tentative
    if(!empty($tentative["score"])){
        echo "Cette tentative est déjà terminée";
        exit();
    }

}

if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_POST["end"]) ) { // remplissage des réponses pas section
    // envoie des : tentative_id, question_id, reponse_utilisateur, correcte
    $tentative_id = $_POST["tentative_id"];
    $question_id = $_POST["question_id"];
    $reponse_utilisateur = $_POST["reponse"];
    $correcte = $_POST["correcte"];
    $date = $_POST["date"];
    $next_section = $_POST["next_section"];

    $stmt = $db->prepare("INSERT INTO reponses(tentative_id, question_id, reponse_utilisateur, correcte)
                        VALUES (?,?,?,?) ");
    $stmt->execute([$tentative_id, $question_id, $reponse_utilisateur, $correcte]);

    // On protège la date pour qu'elle passe sans encombre dans l'URL
    header("Location: quizz.php?date=" . urlencode($date) . "&section=" . $next_section);
    exit();

    //header avec un show 
    // supprimer le contenu de questions_en_cours où tentative_id = celle de l'utilisateur
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["end"])) { // isset une info qui vient du bouton qui termine le quuizz
    // calcul du score et insertion dans tentatives et header vers les résultats
    
    // besoin des réponses de chaque questions où tentative_id = ?
    $stmt = $db->prepare("SELECT reponse_utilisateur, correcte
                            FROM reponses 
                            WHERE tentative_id = ?");
    $stmt->execute([$tentative_id]);
    $reponses = $stmt->fetchAll();

    $score=0;
    foreach ($reponses as $reponse) {
        if($reponse["reponse_utilisateur"] == $reponse["correcte"]){
            $score++;
        }
    }

    $stmt = $db->prepare("UPDATE tentatives set score = ? where id = ?");
    $stmt->execute([$score, $tentative_id]);

    $stmt = $db->prepare("DELETE FROM questions_en_cours WHERE tentative_id = ?");
    $stmt->execute([$tentative_id]);

    header("Locationc: #"); // vers les résultats, pas encore défini

    exit();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src='../Fonction/show.js'></script>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>

<body>

    <?php // affiche les boutons 1 à 10 où on affiche une section ?>

    <?php for($q = 1; $q <= 10; $q++) { ?>
        <button onclick="show('<?= $q ?>')" class="btn"><?= $q ?></button>
    <?php } ?>

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

    } else if ($questions_tmp->rowCount() == 0) {

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
        
        <section class='section' id='<?= $q ?>'>

            <form action="" method="post">

                <p>Question : <?= $row_question["question"] ?> </p>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="1" id="<?=$q?>1">
                        <label for="<?=$q?>1"><?= $row_question["reponse1"] ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="2" id="<?=$q?>2">
                        <label for="<?=$q?>2"><?= $row_question["reponse2"] ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="3" id="<?=$q?>3">
                        <label for="<?=$q?>3"><?= $row_question["reponse3"] ?></label>
                    </p>
                </div>

                <div>
                    <p>
                        <input type="radio" name="reponse" value="4" id="<?=$q?>4">
                        <label for="<?=$q?>4"><?= $row_question["reponse4"] ?></label>
                    </p>
                </div>

                <input type="hidden" name="tentative_id" value="<?= $tentative_id ?>">
                <input type="hidden" name="question_id" value="<?= $row_question["id"] ?>">
                <input type="hidden" name="correcte" value="<?= $row_question["bonne_reponse"] ?>">
                <input type="hidden" name="date" value="<?= $date ?>">
                <input type="hidden" name="next_section" value="<?= $q+1 ?>">

                <button type="submit">Confirm</button>

            </form>

        </section>
        
    <?php 
    $q++;
    } 
    ?>

    <section class="section" id="11">
        <form action="" method="post">
            <h1>Vérifie toutes tes réponses avant de confirmer ^-^</h1>
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