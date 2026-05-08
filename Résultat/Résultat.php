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
    <script src="Résultat.js"></script>
    <link rel="stylesheet" href="../footer/footer.css">
    <title>Document</title>
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

    <h1>score : <?= $score ?></h1>

    <div>

        <?php foreach($results as $result){ 

    // définir juste l'affichage d'une réponse qui a l'id égale à la variable
    // genre getElementById($id_reponse) en rouge et getElementById($id_correcte) en vert
    // et définir la couleur de reponse PUIS celle correcte, comme ça, si la réponse est correcte, on garde le vert
            $id_reponse = $result["reponse_utilisateur"];
            $id_correcte = $result["correcte"];
            
            ?>

            <div>
                <h2><?= htmlspecialchars($result["question"]) ?></h2>
                <p id="1"> <?= htmlspecialchars($result["reponse1"]) ?> </p>
                <p id="2"> <?= htmlspecialchars($result["reponse2"]) ?> </p>
                <p id="3"> <?= htmlspecialchars($result["reponse3"]) ?> </p>
                <p id="4"> <?= htmlspecialchars($result["reponse4"]) ?> </p>
            </div>
            <br>

        <?php } ?>

    </div>

</body>

<footer>
    <?php include "../footer/footer.html" ?>
</footer>

</html>
























<?php

// require_once "../Configuration/config.php";

// $reponses = []; 

// $reponsesJS = [];
// foreach ($reponses as $r) {
//     $reponsesJS[$r['question_id']] = ($r['reponse_utilisateur'] == $r['correcte']);
// }
// <!DOCTYPE html>
// <html lang="en">
// <head>
//     <meta charset="UTF-8">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
//     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
//     <link rel="stylesheet" href="Résultat.css">
//     <script src="Résultat.js"></script>
//     <title>Document</title>
// </head>

// <body>
//     <header>
//         <div class="d-flex align-items-center justify-content-between p-3">
//             <div class="d-flex align-items-center">
//                 <img src="../Image/logo_site_WEB_QUIZZ.png" alt="" width="90" height="90" class="rounded">
//                 <p class="fw-bold fst-italic fs-1 mb-0">WEB QUIZZ</p>
//             </div>
//             <a href="../Page_accueil/Accueil.php" id="retour">Accueil</a>
//         </div>
//     </header>
    
//     <main>
//         <div id="cases"></div>
//     </main>
// </body>
// <script>
//     let reponses = <?= json_encode($reponsesJS)
    
//     creerCases(10, reponses);
// </script>
// </html> ?>