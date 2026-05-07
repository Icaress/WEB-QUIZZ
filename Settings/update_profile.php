<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

require_once "../Configuration/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $new_nom    = htmlspecialchars(trim($_POST['name']));
    $new_prenom = htmlspecialchars(trim($_POST['prenom']));
    $new_email  = htmlspecialchars(trim($_POST['email']));
    $user_id    = $_SESSION['id'];

    $sql = "UPDATE utilisateurs SET nom = ?, prenom = ?, email = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
   
    if ($stmt->execute([$new_nom, $new_prenom, $new_email, $user_id])) {
        $_SESSION['nom'] = $new_nom;
        $_SESSION['prenom'] = $new_prenom;
        $_SESSION['email'] = $new_email;
       header("Location: ../Settings/settings.php?success=1");
    } else {
       header("Location: ../Settings/settings.php?error=1");
    }
}

exit();