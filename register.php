


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<style>
    <?php include "home.css"; ?>
    ::placeholder {
    color: rgba(255, 255, 255, 0.5) !important; 
}
</style>
<body>
    <?php include "navbar.html"; ?>
    <div class="card bg-dark text-white shadow-lg p-4 col-md-6 col-lg-6 mx-auto mt-5 pt-3" style="border-radius: 2rem;">
    <div class="card-body text-center">
        <div class="mb-2">
            <img src="Image/avatar.png" alt="Logo" width="120" height="130" class="d-inline-block align-top mx-auto rounded pt-2">
        </div>  

        <h2 class="fw-bold mb-2">Inscription</h2>
        <p class="text-white-50 mb-4">Crée ton compte WebQuizz dès maintenant</p>

        <form action="inscription_traitement.php" method="POST">
            
            <div class="mb-3 text-start">
                <label class="form-label small">Adresse mail</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" placeholder="Ex : contact@domaine.com" style="padding: 0.8rem;" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3 text-start">
                    <label class="form-label small">Nom d'utilisateur</label>
                    <input type="text" name="pseudo" class="form-control bg-dark text-white border-secondary" placeholder="Pseudo" style="padding: 0.8rem;" required>
                </div>
                <div class="col-md-6 mb-3 text-start">
                    <label class="form-label small">Mot de passe</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary" placeholder="••••••••" style="padding: 0.8rem;" required>
                </div>
            </div>

            <button class="btn btn-outline-light w-100 py-2 fw-bold mb-3 mt-3" type="submit" style="border-radius: 10px;">S'inscrire</button>
        </form>

        <div class="d-flex align-items-center my-3">
            <hr class="flex-grow-1">
            <span class="mx-2 small text-muted">ou</span>
            <hr class="flex-grow-1">
        </div>

        <p class="mb-0 small">Déjà un compte ? <a href="login.php" class="fw-bold text-decoration-none" style="color: #8a84ff;">Se connecter</a></p>

    </div>
</div>
</body>
</html>