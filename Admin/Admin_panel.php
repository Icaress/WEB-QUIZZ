<?php
session_start();
require_once "../Configuration/config.php";
//require_once '../Configuration/Perm_verif.php';


$nb_users    = $db->query("SELECT COUNT(*) as total FROM utilisateurs")->fetch(PDO::FETCH_ASSOC)['total'];
$nb_questions = $db->query("SELECT COUNT(*) as total FROM questions")->fetch(PDO::FETCH_ASSOC)['total'];
$nb_categories = $db->query("SELECT COUNT(*) as total FROM catégorie")->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Admin_panel.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
        <title>Admin</title>
    </head>

    <header>
        <h1>PANNEAU ADMIN</h1>
        <p class="sub">Bienvenue dans votre <?= $_SESSION['nom'] . ' ' . $_SESSION['prenom'] ?></p>
        
    </header>
    <body>
    <div class="admin">
        <div class="grid-stats">
            <div class="stat">
                <div class="label">Questions</div>
                <div class="value"><?= $nb_questions ?></div>
            </div>
            <div class="stat">
                <div class="label">Joueurs</div>
                <div class="value"><?= $nb_users ?></div>
            </div>
            <div class="stat">
                <div class="label">Catégorie</div>
                <div class="value"><?= $nb_categories ?></div>
            </div>
        </div>

        <p class="section-title">Ajouter ou modifier</p>
        <div class="actions">
            <a href="Create_question.php" class="action-card">
                <div class="action-icon blue">+</div>
                <div class="title">Ajouter une question</div>
                <div class="desc">Rempli les données de ta question</div>
            </a>
            <a href="Voir_tout.php" class="action-card">
                <div class="action-icon amber">☰</div>
                <div class="title">Voir tout</div>
                <div class="desc">Voir toutes les catégories et les questions pour pouvoir les modifiers</div>
            </a>
            <a href="Create_categorie.php" class="action-card">
                <div class="action-icon blue">+</div>
                <div class="title">Crée une catégorie</div>
                <div class="desc">Donne vie a une nouvelle catégorie</div>
            </a>
            <a href="Modifier_categorie.php" class="action-card">
                <div class="action-icon green">✎</div>
                <div class="title">Modifier le nom d'une catégorie</div>
                <div class="desc">Modifier ou supprimer une catégorie</div>
            </a>
        </div>

        <p class="section-title">Utilisateurs</p>
        <div class="actions">
            <a href="Users.php" class="action-card">
                <div class="action-icon purple">U</div>
                <div class="title">Voir tout les utilisateurs</div>
                <div class="desc">Gère les utilisateurs</div>
            </a>
            <?php if($_SESSION["perm"] === 2): ?>
            <a href="Sign_up.php" class="action-card">
                <div class="action-icon red">+</div>
                <div class="title">Crée un administrateur</div>
                <div class="desc">Ajouter un compte administrateur</div>
            </a>
            <?php endif; ?>
        </div>
    </div>
    </body>
    </html>