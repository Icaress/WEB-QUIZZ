<?php

include "../Configuration/config.php";

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - Futuriste & Sobre</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../navbar/navbar.css">

    <?php include "../navbar/navbar.php"; ?>

    <style>
        body {
            background-color: #f0f0f0;
            font-family: sans-serif;
            color: #333;
        }

        .profile-container {
            margin-top: 60px;
            margin-bottom: 60px;
        }

        .glass-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .profile-header {
            background: #f5f5f5;
            border-radius: 20px 20px 0 0;
            padding: 35px;
            text-align: center;
            border-bottom: 1px solid #ececec;
        }

        .avatar-circle {
            width: 90px;
            height: 90px;
            background: #e0e0e0;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: #555;
            font-size: 2rem;
        }

        .profile-header h3 {
            font-weight: 800;
            font-size: 1.3rem;
            margin-bottom: 2px;
        }

        .profile-header p {
            color: #888;
            font-size: 0.85rem;
        }

        .btn-update {
            background: #2e2e2e;
            color: white;
            border: none;
            border-radius: 12px;
            padding: 12px 30px;
            font-weight: 700;
            transition: opacity 0.2s;
            width: 100%;
        }

        .btn-update:hover {
            opacity: 0.85;
            color: white;
        }

        .secondary-link {
            color: #888;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .secondary-link:hover {
            color: #333;
        }
    </style>
</head>
<body>


    <div class="container profile-container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-5">
                
                <div class="card glass-card">
                    <div class="profile-header">
                        <div class="avatar-circle">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <h3 class="fw-bold mb-1">Mon Profil</h3>
                        <p class="small opacity-75">Paramètres du compte</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success py-2 text-center rounded-pill mb-4 border-0 shadow-sm">
                            <i class="fa-solid fa-check-circle me-2"></i> Profil mis à jour avec succès !
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger py-2 text-center rounded-pill mb-4 border-0 shadow-sm">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i> Erreur lors de la mise à jour.
                            </div>
                        <?php endif; ?>
                        <form action="../Settings/update_profile.php" method="POST">
                            
                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?= htmlspecialchars($_SESSION['nom']) ?>">
                                <label for="name"><i class="fa-regular fa-user me-2"></i>Nom</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Prénom" value="<?= htmlspecialchars($_SESSION['prenom']) ?>">
                                <label for="prenom"><i class="fa-regular fa-user me-2"></i>Prénom</label>
                            </div>

                            <div class="form-floating mb-4">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= htmlspecialchars($_SESSION['email']) ?>">
                                <label for="email"><i class="fa-regular fa-envelope me-2"></i>Adresse mail</label>
                            </div>


                            <div class="d-grid gap-2 mt-5">
                                <button type="submit" class="btn btn-update">
                                    Mettre à jour
                                </button>
                            </div>

                        </form>

                        <div class="text-center mt-4">
                            <hr class="text-muted opacity-25">
                            <a href="../Connexion_page/log_out.php" class="secondary-link text-danger">Déconnexion</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="../Page_accueil/Accueil.php" class="secondary-link">
                        <i class="fa-solid fa-chevron-left small"></i> Retour à l'accueil
                    </a>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>