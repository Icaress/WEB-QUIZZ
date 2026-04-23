<nav class="navbar navbar-expand-md">

    <div class="container-fluid">

        <img src="../Image/logo_site_WEB_QUIZZ.png" alt="Logo" width="120" height="120" class="d-inline-block align-top me-2 rounded pt-2">
        <a class="navbar-brand fw-bold fst-italic fs-1" href="#">WEB QUIZZ</a>
        
        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="nothing-left"></div>

            <div id='options' class="navbar-nav fw-normal fs-5">
              <a class="nav-link active" aria-current="page" href="../Page_accueil/Accueil.php" onclick="show('Accueil')">Accueil</a>
              <a class="nav-link active" href="#" onclick="show('QUIZZ')">QUIZZ</a>
              <a class="nav-link active" href="#" onclick="show('Historique')">Historique</a>
                <?php 
                    if (!isset($_SESSION["id"])){
                        echo "<a class='nav-link active' href='../Connexion_page/login.php' aria-disabled='true'>Se connecter</a>";
                    } else { ?>
                        <button class="ms-3" data-bs-toggle="collapse" data-bs-target="#log_out" >
                            <img src="../Image/Avatar.png" alt="Pdp">
                        </button>
                        <div class="collapse" id="log_out">
                            <div class="d-flex flex-column">
                                <a href="">Settings</a>
                                <a href="../Connexion_page/log_out.php">Log out</a>
                            </div>
                        </div>
                <?php } ?>
            </div>

            <div class="nothing-right"></div>
        </div> 

    </div>

</nav>