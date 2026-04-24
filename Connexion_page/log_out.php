<?php 

session_start();
session_destroy();
header("Location: ../Page_accueil/Accueil.php");
exit();

?>