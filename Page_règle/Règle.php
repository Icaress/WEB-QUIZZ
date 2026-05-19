<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="../Fonction/show.js"></script>
    <script src="Règle.js"></script>
    <link rel="stylesheet" href="règle.css">
    <title>Règle</title>
</head>
<header>
    <div class="d-flex align-items-center justify-content-between p-3">
        <div class="d-flex align-items-center">
            <img src="../Image/logo_site_WEB_QUIZZ.png" alt="" width="90" height="90" class="rounded">
            <p class="fw-bold fst-italic fs-1 mb-0">WEB QUIZZ</p>
        </div>
        <a href="../Page_accueil/Accueil.php" id="retour">Retour</a>
    </div>
</header>
<body>
    <section class='section' id="Présentation">
        <div class="text-center m-3 p-4 rounded-5" id="desc">
            <p class="p1">"Catégorie nom"</p>
            <p class="p2">Vous allez commencer le Quizz "Catégorie nom". Veuillez noter les règles qui vont être prescrit dans un instant après le bouton.</p>
            <button onclick="show('Règle')" class="btn">Préparé-vous</button>
        </div>
    </section>

    <section class='section' id="Règle">
        <div class="text-center p-4 rounded-5 mt-" id="desc_2">
            <p class="p1">Les Règles</p>
            <p class="p2_">-Le QCM sera lancé en pleine écran, si vous le quittez vous serez sanctionné .<br>-Si vous changer d’onglet cela sera détecter et vous serez également sanctionné.<br>-Le QCM aura un temp défini selon le créateur de celui-ci.<br>-Les pages ne seront pas modifiable ni sélectionnable durant le QCM.</p>
            <button onclick="window.location.href='../Question/QUIZZ.php'" class="btn">Commencer</button>
        </div>
    </section>
</body>
</html>