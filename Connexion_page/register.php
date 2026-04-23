<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once "../Configuration/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $email = trim($_POST['email']);
    $Nom = trim($_POST['Nom']);
    $Prenom = trim($_POST['Prenom']);
    $mdp = $_POST['mdp'];
    $perm = 0;

    $check = $db->prepare("SELECT * FROM users WHERE email = ?");
    $check->execute([$email]);
    $exists = $check->fetch(PDO::FETCH_ASSOC);

    if ($exists) {
        echo "Email déjà utilisé";
    } else {
        $hash = password_hash($mdp, PASSWORD_BCRYPT);
    
        $stmt = $db->prepare("INSERT INTO users (email, Nom, Prénom, mdp, perm) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$email, $Nom, $Prenom, $hash, $perm]);
        header("Location: login.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <title>Inscription</title>
</head>
<style>
    <?php include "home.css"; ?>
    ::placeholder {
    color: rgba(255, 255, 255, 0.5) !important; 
    }
</style>

<header>
    <?php include "../navbar/navbar.html"; ?>
</header>

<body>
    <div class="card bg-dark text-white shadow-lg p-4 col-md-6 col-lg-6 mx-auto mt-5 pt-3" style="border-radius: 2rem;">
        <div class="card-body text-center">
            <div class="mb-2">
                <img src="../Image/avatar.png" alt="Logo" width="120" height="130" class="d-inline-block align-top mx-auto rounded pt-2">
            </div>  

            <h2 class="fw-bold mb-2">Inscription</h2>
            <p class="text-white-50 mb-4">Crée ton compte WebQuizz dès maintenant</p>

            <form action="register.php" method="POST">
            
                <div class="row" style="margin-bottom: 0% !important;">
                    <div class="col-md-6 mb-3 text-start">
                        <label class="form-label big">Nom</label>
                        <input type="text" name="Nom" class="form-control bg-dark text-white border-secondary" placeholder="Nom" style="padding: 0.8rem;" required>
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label class="form-label big">Prénom</label>
                        <input type="text" name="Prenom" class="form-control bg-dark text-white border-secondary" placeholder="Prénom" style="padding: 0.8rem;" required>
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label big">Adresse mail</label>
                    <input type="email" name="email" class="form-control bg-dark text-white border-secondary" placeholder="Ex : contact@domaine.com" style="padding: 0.8rem;" required>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label big">Mot de passe</label>
                    <input type="password" name="mdp" class="form-control bg-dark text-white border-secondary" placeholder="Mot de passe" style="padding: 0.8rem;" required>
                </div>
            

                <button class="btn btn-outline-light w-100 py-2 fw-bold mb-3 mt-3" type="submit" style="border-radius: 10px;">S'inscrire</button>
            </form>

            <div class="d-flex align-items-center my-3">
                <hr class="flex-grow-1">
                <span class="mx-2 small text-muted">ou</span>
                <hr class="flex-grow-1">
            </div>

            <p class="mb-0 small">Déjà un compte ? <a href="../login.php" class="fw-bold text-decoration-none" style="color: #8a84ff;">Se connecter</a></p>

        </div>
    </div>
</body>
</html>