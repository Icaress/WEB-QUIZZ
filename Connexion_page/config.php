<?php

//CE CODE EST A IMPORTER DANS LE PHP DE CHAQUE PAGE AFIN DE SE CONNECTER A LA BASE DE DONNEES

$host = "localhost"; // Adresse du serveur de base de données
$dbname = "web_quizz"; // Nom de la base de données
$user = "root"; // Nom d'utilisateur de la base de données
$pass = "root"; // Mot de passe de la base de données

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

//ON APPEL CE CODE AVEC LA COMMANDE : require_once "config.php"; comme dans le login.php

?>

