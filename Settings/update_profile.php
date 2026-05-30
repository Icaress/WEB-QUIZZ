<?php

$new_nom    = htmlspecialchars(trim($_POST['name']));
$new_prenom = htmlspecialchars(trim($_POST['prenom']));
$new_email  = htmlspecialchars(trim($_POST['email']));
$user_id    = $_SESSION['id'];

$check = $db->prepare("SELECT * FROM utilisateurs WHERE email = ?");
$check->execute([$new_email]);
$exists = $check->fetch(PDO::FETCH_ASSOC);

if ($exists) {
    echo "<h3 style='color: #ff0000;'>Email déjà utilisé ... Veuillez en choisir un autre !</h3>";
}
else {
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

