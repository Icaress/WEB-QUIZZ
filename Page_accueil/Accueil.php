<?php 
session_start();

require_once "../Configuration/config.php";

$categories = $db->query("SELECT * FROM `catégorie`")->fetchAll(PDO::FETCH_ASSOC);

$nb_users    = $db->query("SELECT COUNT(*) as total FROM utilisateurs")->fetch(PDO::FETCH_ASSOC)['total'];
$nb_questions = $db->query("SELECT COUNT(*) as total FROM questions")->fetch(PDO::FETCH_ASSOC)['total'];
$nb_categories = $db->query("SELECT COUNT(*) as total FROM catégorie")->fetch(PDO::FETCH_ASSOC)['total'];
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
    <?php // Accueil ?>
    <section class='section' id='Accueil'>
        <div class="text-center m-3 p-4 rounded-5" id="desc">
            <div class="d-inline-block px-5 rounded-4">
                <p>Informatique & Tech</p>
            </div>
                <p class="p1">Teste tes connaissances </p>
                <p class="sous_texte">Des questions sur le web, les bases de données, les algorithmes et plus encore.</p>
                <button onclick="show('QUIZZ')" class="btn">Commencer le quiz</button>
        </div>

            <div class="info">
                <div> <p class="big"><?= $nb_questions ?></p> <p>questions</p> </div>
                <div> <p class="big"><?= $nb_users?></p> <p>Joueurs</p> </div>
                <div> <p class="big"><?= $nb_categories?></p> <p>Catégories</p> </div>
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

    <?php //Quizz ?>
    <section class='section' id='QUIZZ'>
        <div class="text-center m-5 p-4 rounded-5" id="desc">
            <br>
            <p class="p1">Choix de la catégorie du QUIZZ </p>
            <p class="sous_texte">Choisir une catégorie te permet de jouer dans le domaine qui t'intéresse le plus, que ce soit le JavaScript, les bases de données ou les algorithmes. Comme ça tu progresses là où tu en as vraiment besoin, à ton rythme.</p>
            <button onclick="document.getElementById('section_quizz').scrollIntoView({behavior: 'smooth'})">Commencer le quiz</button>
        </div>
        <section id='section_quizz'>
            <div id="catégories" class="row">    
                <?php foreach ($categories as $C) :?>
                    <div class="cat m-4 col-6">
                        <h1><?= $C["nom"]?></h1>
                        <p><?= $C["description"]?></p>
                        <?php
                        if(!isset($_SESSION['id'])){
                            echo '<a href="../Connexion_page/login.php">Commencer</a>';
                        }
                        else{
                            echo '<a href="../Quizz/quizz.php?catégorie=' . $C["id"] . '">Commencer</a>';
                        }
                        ?>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
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