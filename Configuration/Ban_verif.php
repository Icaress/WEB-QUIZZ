<?php 

if(isset($_SESSION["ban"])){
    if($_SESSION["ban"] > 0) {
        header("Location: ../Page_accueil/Accueil.php?banned=1");
        exit();
    }
} else {
    header("Location: ../Page_accueil/Accueil.php");
    exit();
}