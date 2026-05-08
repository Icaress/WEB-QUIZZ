<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
session_start();
require_once "../Configuration/config.php";


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
    
    <main>
        <div id="cases"></div>
    </main>
</body>
<script>
    let reponses = <?= json_encode($reponsesJS) ?>;
    creerCases(10, reponses);
</script>
</html>