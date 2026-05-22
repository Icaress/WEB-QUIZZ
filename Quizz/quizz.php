<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Europe/Paris');

require "../Configuration/config.php";
require_once "../Configuration/Ban_verif.php";

$utilisateur_id = $_SESSION["id"];


// Ici, création d'une nouvelle tentative
if(isset($_GET["catégorie"])){ 
    $catégorie = $_GET["catégorie"];
    
    $date = (new DateTime())->format('Y-m-d H:i:s');

    $stmt = $db->prepare("INSERT INTO tentatives(utilisateur_id, date) VALUES (?,?)");
    $stmt->execute([$utilisateur_id, $date]);

    // On récupère directement l'ID généré (le dernier)
    $tentative_id = $db->lastInsertId();
}

// Remplissage de la BDD
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["end"])) {

    $tentative_id = $_POST["tentative_id"];
    $catégorie = $_POST["catégorie"];

    // $_POST["reponses"] = [ question_id => "reponse_choisie" ]
    // $_POST["correctes"] = [ question_id => "bonne_reponse" ]
    
    $reponses  = $_POST["reponses"];  // tableau
    $correctes = $_POST["correctes"]; // tableau

    $score = 0;

    foreach ($reponses as $question_id => $reponse_utilisateur) {

        $correcte = $correctes[$question_id];

        if ($reponse_utilisateur == $correcte) {
            $score++;
        }

    $stmt = $db->prepare("INSERT INTO reponses (tentative_id, question_id, reponse_utilisateur, correcte) VALUES (?,?,?,?)");
    $stmt->execute([$tentative_id, $question_id, $reponse_utilisateur, $correcte]);

    }

    // Mise à jour du score dans tentatives
    $stmt = $db->prepare("UPDATE tentatives SET score = ? WHERE id = ?");
    $stmt->execute([$score, $tentative_id]);

    header("Location: ../Résultat/Résultat.php?tentative_id=$tentative_id");
    exit();
}

$cooldown_db = (int)$db->query("SELECT time FROM timer")->fetchColumn();

$stmt = $db->prepare("SELECT date FROM tentatives WHERE utilisateur_id = ? ORDER BY date DESC LIMIT 1");
$stmt-> execute([$utilisateur_id]);
$past_db = $stmt->fetchColumn();

$now = new DateTime();
$past = new DateTime($past_db);
$duration = $past->diff($now);
$seconds_db = ($duration->days * 86400) + ($duration->h * 3600) + ($duration->i * 60) + $duration->s;
$seconds = $cooldown_db - $seconds_db; 

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
    <script src="../Fonction/anticheat.js" defer></script>
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

    // s'il n'y en a pas, prendre 10 questions au hasard 

    $questions_fetch = $db->prepare("SELECT * FROM questions WHERE catégorie = ? ORDER BY RAND() LIMIT 10");
    $questions_fetch->execute([$catégorie]);
    
    $questions = $questions_fetch->fetchAll();
    
    $q = 1;

    ?>

    <form action="" method="post">

    <?php foreach ($questions as $row_question) { ?>
        <section class="section" id="<?= $q ?>">

            <form action="" method="post" class="quizz_form">

            <?php for ($i = 1; $i <= 4; $i++) { ?>
                <p>
                    <input type="radio" 
                        name="reponses[<?= $row_question["id"] ?>]" 
                        value="<?= $i ?>" 
                        id="<?= $q ?><?= $i ?>">
                    <label for="<?= $q ?><?= $i ?>">
                        <?= htmlspecialchars($row_question["reponse$i"]) ?>
                    </label>
                </p>
            <?php } ?>

            <input type="hidden" 
                name="correctes[<?= $row_question["id"] ?>]" 
                value="<?= $row_question["bonne_reponse"] ?>">

            <button type="button" onclick="show('<?= $q+1 ?>')" id="next_question">Next question</button>

        </section>
    <?php $q++; } ?>

    

<<<<<<< HEAD
        <section class="section" id="terminer">
=======
    <section class="section" id="terminer">
        <form action="" method="post" class="quizz_form">
>>>>>>> 024e711a2b864f0db94d1f457ade0a9b63bf517d
            <h2>Tu as répondu à toutes les questions ! 🎉</h2>
            <p>Vérifie bien tes réponses avant de valider, tu ne pourras plus les modifier.</p>
            <input type="hidden" name="end" value="yes">
            <input type="hidden" name="catégorie" value="<?= $catégorie ?>">
            <input type="hidden" name="tentative_id" value="<?= $tentative_id ?>">
            <input type="hidden" name="date" value="<?= $date ?>">

            <button type="submit" id="end_quizz">Terminer le quizz</button>
<<<<<<< HEAD
        </section>

    </form>
=======
        </form>
    </section>
    
    <?php // ajouter une variable qui active un show (suivant la dernière réponse remplie) 
    
    if(isset($_GET["section"])){ 
        $section = $_GET['section']; ?>
>>>>>>> 024e711a2b864f0db94d1f457ade0a9b63bf517d

    <?php // affiche la première section au début de la page ?>
    <script>show('1')</script>

    <script>
        let seconds = <?= $seconds ?> ;
        let date = "<?= $date ?>";
    </script>

</body>

</html>