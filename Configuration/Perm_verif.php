<?php

// vérifie si connecté en admin
if (isset($_SESSION["id"])){
    if($_SESSION["role"] < 1){
        header("Location: ../Page_accueil/Accueil.php");
        exit();
    }
}
else {
    header("Location: ../Page_accueil/Accueil.php");
    exit();
}

