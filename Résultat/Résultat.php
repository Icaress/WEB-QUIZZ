<?php 

date_default_timezone_set('Europe/Paris');

require "../Configuration/config.php";

if(isset($_GET["tentative_id"])){

    $tentative_id = $_GET["tentative_id"];

    // prendre les questions avec réponses 
    $temp = $db->prepare("SELECT questions.question, questions.reponse1, questions.reponse2, questions.reponse3, questions.reponse4, reponses.correcte, reponses.reponse_utilisateur
                            FROM reponses
                            JOIN questions ON questions.id = reponses.question_id
                            WHERE reponses.tentative_id = ?
                            ");
    $temp->execute([$tentative_id]);
    $results = $temp->fetchAll();

    $temp = $db->prepare("SELECT score FROM tentatives WHERE id = ?");
    $temp->execute([$tentative_id]);
    $score = $temp->fetchColumn();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Résultat.css">
    <title>Votre Résultat</title>
</head>

<body>
    <header>
        <div class="d-flex align-items-center justify-content-between p-3">
            <div class="d-flex align-items-center">
                <img src="../Image/logo_site_WEB_QUIZZ.png" alt="" width="90" height="90" class="rounded">
                <p class="fw-bold fst-italic fs-1 mb-0">WEB QUIZZ</p>
            </div>
            <a href="../Page_accueil/Accueil.php" id="retour">Accueil</a>
        </div>
    </header>

    <div id="score">
        <h1>Vous avez obtenu <?= $score ?> / 10</h1>
    </div>

    <div id="wrapper">
        <div id='conteneur'>
            <?php for($q = 1; $q <= 10; $q++) { ?>
                <button onclick="show('<?= $q ?>')" class="nbr btn"><?= $q ?></button>
            <?php } ?> 
        </div>  
    </div>
    
    <?php 
    $q = 1;
    foreach($results as $result){ 
        $id_reponse = $result["reponse_utilisateur"];
        $id_correcte = $result["correcte"];
        
        $reponses_texte = [
            1 => $result["reponse1"],
            2 => $result["reponse2"],
            3 => $result["reponse3"],
            4 => $result["reponse4"],
        ];

        $texte_utilisateur = $reponses_texte[$id_reponse];
        $texte_correcte = $reponses_texte[$id_correcte];
?>

        <section class="section" id="<?= $q ?>">
            <div>
                <h2><?= htmlspecialchars($result["question"]) ?></h2>

                <?php foreach([1,2,3,4] as $i): ?>
                    <p class="reponse-btn <?= ($i == $id_correcte) ? 'correcte' : 'incorrecte' ?>">
                    <?= htmlspecialchars($result["reponse$i"]) ?>
                    </p>
                <?php endforeach; ?>
                <p id='ppp'>
                <?= ($id_reponse == $id_correcte) ? '✅' : '❌' ?> 
                Votre réponse : <?= htmlspecialchars($texte_utilisateur) ?>
                </p>
            </div>
        </section>

    <?php 
    $q++;
    } ?>

    <script src='../Fonction/show.js'></script>
    <script>show('1')</script>
</body>
</html>
