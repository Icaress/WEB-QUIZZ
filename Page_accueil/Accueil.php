<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src='../Fonction/show.js'></script>
    <script src='Debut_accueil.js'></script>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="Accueil.css">
    <link rel="stylesheet" href="../footer/footer.css">
    <link rel="stylesheet" href="QUIZZ.css">
    <link rel="stylesheet" href="Historique.css">
</head>

<header>
    <?php include "../navbar/navbar.php" ?>
</header>

<body>
    <?php // Acceuil ?>
    <section class='section' id='Accueil'>
        <div class="container">
            <div class="text-center m-3 p-4 rounded-5" id="desc">
                <div class="d-inline-block px-5 rounded-4">
                    <p>Informatique & Tech</p>
                </div>
                    <p class="p1">Teste tes connaissances </p>
                    <p class="sous_texte">Des questions sur le web, les bases de données, les algorithmes et plus encore.</p>
                    <button onclick="show('QUIZZ')" class="btn">Commencer le quiz</button>
            </div>

            <div class="info">
                <div> <p class="big">240</p> <p>questions</p> </div>
                <div> <p class="big">1.2k</p> <p>Joueurs</p> </div>
                <div> <p class="big">8</p> <p>Catégories</p> </div>
            </div>

            <div class="row justify-content-center align-items-center my-5 w-100">
                <p class="classement text-center">🏆 Classement</p>
                <div class="bg-dark text-white p-3 m-0" id="classement">
                    <p class="d-flex justify-content-between">
                        1 &emsp; Alex L. 
                        <span>9 840 pts</span>
                    </p>
                </div>
            </div>

        </div>
    </section>

    <?php // Quizz ?>
    <section class='section' id='QUIZZ'>
        <div class="text-center m-3 p-4 rounded-5" id="desc">
            <br>
            <p class="p1">Choix de la catégorie du QUIZZ </p>
            <p class="sous_texte">Choisir une catégorie te permet de jouer dans le domaine qui t'intéresse le plus, que ce soit le JavaScript, les bases de données ou les algorithmes. Comme ça tu progresses là où tu en as vraiment besoin, à ton rythme.</p>
            <button type="submit" class="btn">Commencer le quiz</button>
            <section id='section_quizz'>

            </section>
        </div>

        <div id="catégories">
            <form action="" method="">
                <div class="btn">
                    HTML / CSS
                    <a href="../Quizz/quizz.php?catégorie=1">ok</a>
                </div>
                <div class="btn">
                    JavaScript
                    <a href="../Quizz/quizz.php?catégorie=2">ok</a>
                </div>

                <div class="btn">
                    Base de données
                    <a href="../Quizz/quizz.php?catégorie=3">ok</a>
                </div>

                <div class="btn">
                    Algorithmes
                    <a href="../Quizz/quizz.php?catégorie=4">ok</a>
                </div>
            </form>
        </div>
    </section>

    <?php // Historique ?>
    <section class='section' id='Historique'>
        <div id="titre_histo">
            <h1>Historique</h1>
            <p>Tous les Quizz joués</p>
            <div id='historique'>
                
            </div>
        </div>
    </section>
</body>

<footer>
    <?php include "../footer/footer.html" ?>
</footer>

</html>