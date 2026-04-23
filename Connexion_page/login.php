<?php
session_start();
require_once "../Configuration/config.php";

if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = $_POST['email'];
    $password = $_POST['mdp'];
    $perm = 0;

    $query = $db->prepare("SELECT * FROM utilisateurs WHERE email = :email");

    $query->execute(['email' => $email]);

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['id'] = $user['id'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['role'] = $user['role'];
        header("Location: ../Page_accueil/Accueil.php");
        exit();
    } else {
        echo "Nom d'utilisateur ou mot de passe incorrect.";
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <title>Se connecter</title>
</head>

<style>
    ::placeholder {
    color: rgba(255, 255, 255, 0.5) !important; 
}
</style>

<header>
    <?php include "../navbar/navbar.php" ?>
</header>

<body class="bg-light"> 
    <div class="container">
        <div class="row vh-100 justify-content-center align-items-center">
        
            <div class="col-11 col-md-6 col-lg-5">
            
                <div class="card bg-dark text-white shadow-lg p-4" style="border-radius: 2rem;">
                    <div class="card-body text-center">
                    
                        <div class="mb-3" style="display: flex; justify-content: center;">
                            <img src="../Image/avatar.png" alt="Logo" width="120" height="120" class="d-inline-block align-top" style="margin-bottom: 0%;">
                        </div>

                        <h2 class="fw-bold mb-2">Connexion</h2>
                        <p class="text-white-50 mb-4">Accède à ton compte WebQuizz</p>

                        <form action="login.php" method="POST">
                            <div class="mb-3 text-start w-70">
                                <label class="form-label big">Email</label>
                                <input type="text" name="email" class="form-control bg-dark text-white border-secondary" placeholder="Ex : WebQuizz@gmail.com" style="padding: 0.8rem;">
                            </div>

                            <div class="mb-1 text-start w-70">
                                <label class="form-label big">Mot de passe</label>
                                <input type="password" name="mdp" class="form-control bg-dark text-white border-secondary" placeholder="Mot de passe" style="padding: 0.8rem;">
                            </div>
                        
                            <div class="text-end mb-4 pt-3">
                                <a href="#" class="text-decoration-none small" style="color: #8a84ff;">Mot de passe oublié ?</a>
                            </div>

                            <button class="btn btn-outline-light w-100 py-2 fw-bold mb-3" type="submit" style="border-radius: 10px;">Se connecter</button>
                        </form>

                        <div class="d-flex align-items-center my-3">
                            <hr class="flex-grow-1">
                            <span class="mx-2 small text-muted">ou</span>
                            <hr class="flex-grow-1">
                        </div>

                        <p class="mb-0 small">Pas encore de compte ? <a href="register.php" class="fw-bold text-decoration-none" style="color: #8a84ff;">S'inscrire</a></p>

                    </div>
                </div>
            
            </div>
        </div>
    </div>
</body>
</html>