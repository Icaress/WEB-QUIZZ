<?php
require "config.php"

// vérifie si connecté en admin
if (isset($_SESSION["user_id"])){
    if($_SESSION["perm"] < 1){
        header("Location: ../Page_accueil/Accueil.php");
    }
}
else {
    header("Location: ../Admin/Admin_panel.php");
}
?>