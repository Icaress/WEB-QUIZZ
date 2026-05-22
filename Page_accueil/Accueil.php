<?php 

require_once "../Configuration/config.php";

if(isset($_SESSION["id"])){
    $user_id = $_SESSION["id"];
}

if(isset($_GET["banned"])){
    echo "<h1 style='color: #ff0000dd;'>The hammer of justice has fallen on you !!!</h1>
            <h4 style='color: #ff0000dd;'>You are still banned from doing any quizz ... Please behave well when it will be lifted :)</h4>";
}

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
    <script src='Historique.js' defer></script>
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
        <?php
        $temp = $db->prepare("
            SELECT 
            utilisateurs.nom,
            utilisateurs.id,
            COUNT(*) AS total_tentatives,
            AVG(tentatives.score) AS avg_score,
            MAX(tentatives.score) AS max_score
            FROM tentatives
            JOIN utilisateurs ON utilisateurs.id = tentatives.utilisateur_id
            GROUP BY tentatives.utilisateur_id, utilisateurs.nom, utilisateurs.id
            ORDER BY avg_score DESC
            LIMIT 5
        ");
$temp->execute();
        $classement = $temp->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <div class="row justify-content-center my-5 w-100 m-0">
            <div class="col-15 col-md-8 col-lg-10">
                <div class="card bg-border text-white border-secondary shadow-lg rounded-4 overflow-hidden">
                    
                    <div class="card-header border-secondary bg-gradient p-3 text-center" style="background-color: #868686;">
                        <h3 class="m-0 fw-bold tracking-wide" style="font-size: 1.6rem; color: #ffc107;">🏆 Classement Top 5</h3>
                        <p class="text-muted small m-0 mt-1">Les meilleurs joueurs selon leur moyenne de points</p>
                    </div>

                    <div class="card-body p-3" style="background-color: #858585;">
                        <?php 
                        $medals = ['🥇', '🥈', '🥉', '4️⃣', '5️⃣'];
                        foreach ($classement as $index => $joueur): 
                            $isCurrentUser = $joueur['id'] == $user_id;
                            // Style spécial si c'est l'utilisateur connecté
                            $rowStyle = $isCurrentUser 
                                ? 'background: linear-gradient(90deg, rgba(255, 193, 7, 0.15), rgba(0,0,0,0)); border: 1px solid #ffc107;' 
                                : 'background: #878787; border: 1px solid #2d2d2d;';
                        ?>
                            <div class="d-flex justify-content-between align-items-center p-3 mb-2 rounded-3 shadow-sm transition-all" 
                                 style="<?= $rowStyle ?>">
                                
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 me-3" style="min-width: 30px; text-align: center;"><?= $medals[$index] ?></span>
                                    <div>
                                        <span class="fw-semibold <?= $isCurrentUser ? 'text-warning fs-5' : 'text-light' ?>">
                                            <?= htmlspecialchars($joueur['nom']) ?>
                                        </span>
                                        <?php if ($isCurrentUser): ?>
                                            <span class="badge bg-warning text-dark ms-1" style="font-size: 0.65rem; vertical-align: middle;">VOUS</span>
                                        <?php endif; ?>
                                        <div class="text-muted" style="font-size: 0.75rem;">
                                            <?= $joueur['total_tentatives'] ?> tentative<?= $joueur['total_tentatives'] > 1 ? 's' : '' ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-end">
                                    <div class="fw-bold text-warning fs-5">
                                        <?= number_format($joueur['avg_score'], 1) ?> <span class="small fw-normal text-muted" style="font-size: 0.8rem;">pts moy.</span>
                                    </div>
                                    <div class="text-muted" style="font-size: 0.7rem;">
                                        Record : <span class="text-success fw-bold"><?= $joueur['max_score'] ?>/10</span>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>

                        <?php if (empty($classement)): ?>
                            <div class="text-center py-4">
                                <p class="text-muted m-0">Aucun résultat enregistré pour le moment. Soyez le premier ! 🚀</p>
                            </div>
                        <?php endif; ?>
                    </div>

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
                            echo '<a href="../Page_règle/Règle.php?catégorie=' . $C["id"] . '">Commencer</a>';
                        }

                        ?>
                        
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    </section>

    <?php 
    if(isset($_SESSION["id"])){
        
        $temp=$db->prepare("SELECT COUNT(*) AS total_tentatives, AVG(score) AS total_score, MAX(score) AS max_score
                            FROM tentatives
                            WHERE utilisateur_id = ?
                            ");
        $temp->execute([$user_id]);
        $nombres = $temp->fetch(PDO::FETCH_ASSOC);
        $total_tentatives = $nombres["total_tentatives"];
        $total_score = $nombres["total_score"];
        $max_score = $nombres["max_score"];

        $catégories = $db->query("SELECT id, nom FROM catégorie")->fetchAll();
        
        $temp = $db->prepare("SELECT DISTINCT questions.catégorie , tentatives.date, tentatives.score
                                FROM tentatives
                                JOIN reponses ON reponses.tentative_id = tentatives.id
                                JOIN questions ON questions.id = reponses.question_id
                                WHERE utilisateur_id = ?
                                ");
        $temp->execute([$user_id]);
        $resultats = $temp->fetchAll();

        ?>

        <?php // Historique ?>
        <section class='section' id='Historique'>
            <div class="p-0" id="after_historique">
                <div id="titre_histo">
                    <h1>Historique</h1>
                    <p>Tous les Quizz joués</p>
                    <div id='historique'>
                        
                    </div>
                </div>

                <div class="d-flex" id="stats">
                    <div>
                        <h1><?= $total_tentatives ?></h1>
                        <p>Parties jouées</p>
                    </div>

                    <div>
                        <h1><?= number_format($total_score, 2) ?></h1>
                        <p>Moyenne</p>
                    </div>

                    <div>
                        <h1><?= $max_score ?></h1>
                        <p>Meilleur score</p>
                    </div>
                </div>

                <div id="filtre-wrapper">

                    <button id="filtre-toggle" onclick="toggler()">☰ Filtres</button>

                    <div id="filtre-container">
                        <button onclick="show_all_category()" class='btn filtre-btn'>Tout</button>
                        <?php 
                        $catégorie_id_nom = [];
                        foreach($catégories as $catégorie){ 
                            $catégorie_id = $catégorie["id"];
                            $catégorie_nom = $catégorie["nom"];
                            $catégorie_id_nom[$catégorie_id] = $catégorie_nom; 
                        ?>
                            <button onclick="show_category(<?= $catégorie['id'] ?>)" class='btn filtre-btn'><?= $catégorie['nom'] ?></button>
                        <?php } ?>
                    </div>
                </div>

                <br><br>

                <div>
                    <?php foreach ($resultats as $resultat){ 
                        $idCatégorie = $resultat["catégorie"];
                        $nomCatégorie = $catégorie_id_nom[$idCatégorie];
                        $pct = ($resultat["score"] / 10) * 100;

                        if ($pct >= 80) { $badge = "Excellent"; $couleur = "#c3ffc3"; }
                        elseif ($pct >= 60) { $badge = "Bien"; $couleur = "#fff5ba"; }
                        elseif ($pct >= 40) { $badge = "Moyen"; $couleur = "#ffe9bf"; }
                        else { $badge = "À améliorer"; $couleur = "#ffbebe"; }

                        $date = new DateTime($resultat["date"]);
                        $aujourd_hui = new DateTime();
                        if ($date->format("d/m/Y") == $aujourd_hui->format("d/m/Y")) {
                            $date_affichage = "Aujourd'hui, " . $date->format("H\hi");
                        } else {
                            $date_affichage = $date->format("d/m/Y à H:i");
                        }
                    ?>
                        <div class="category_results" data-category="<?= $idCatégorie ?>">
                            <div class="cr-left">
                                <div class="score-cercle" style="background-color: <?= $couleur ?>">
                                    <span><?= $resultat["score"] ?>/10</span>
                                </div>
                                <div class="cr-info">
                                    <h3 class="m-0"><?= $nomCatégorie ?></h3>
                                    <p class="m-0"><?= $date_affichage ?></p>
                                </div>
                            </div>
                            <div class="cr-right">
                                <h2><?= $pct ?>%</h2>
                                <span class="badge-result" style="background-color: <?= $couleur ?>"><?= $badge ?></span>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </section>
    <?php } else { ?>
        <section class='section' id='Historique'>
            <div id="titre_histo">
                <h1>Historique</h1>
                <p>Veuillez vous connecter pour voir votre historique</p>
            </div>
        </section>
    <?php } ?>

    <footer>
        <?php include "../footer/footer.html" ?>
    </footer>

</body>

</html>