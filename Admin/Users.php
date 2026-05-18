<?php
require_once "../Configuration/config.php";

// Suppression
if(isset($_GET["supprimer"])){
    $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$_GET["supprimer"]]);
    header("Location: gestion_users.php");
    exit();
}

$stmt = $db->query("SELECT id, nom, prenom, email, role FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="Users.css">
</head>
<body>

<h1>Gestion des utilisateurs</h1>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($utilisateurs as $user) { ?>
            <tr>
                <td><?= $user["id"] ?></td>
                <td><?= htmlspecialchars($user["nom"]) ?></td>
                <td><?= htmlspecialchars($user["prenom"]) ?></td>
                <td><?= htmlspecialchars($user["email"]) ?></td>
                <td>
                    <span class="<?= $user["role"] == 2 ? 'role-admin' : 'role-user' ?>">
                        <?= $user["role"] == 2 ? "Admin" : "Utilisateur" ?>
                    </span>
                </td>
                <td>
                    <a href="?supprimer=<?= $user["id"] ?>" 
                       onclick="return confirm('Supprimer <?= htmlspecialchars($user["prenom"]) ?> <?= htmlspecialchars($user["nom"]) ?> ?')">
                        <button class="btn-supprimer">Supprimer</button>
                    </a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

</body>
</html>