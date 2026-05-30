<?php

require_once "../Configuration/config.php";
require_once "../Configuration/Perm_verif.php";

// Suppression
if(isset($_GET["supprimer"])){
    $stmt = $db->prepare("DELETE FROM utilisateurs WHERE id = ?");
    $stmt->execute([$_GET["supprimer"]]);
    header("Location: Users.php");
    exit();
}

if(isset($_GET["ban"])){
    if($_GET["ban"] == $_SESSION["id"]){
        echo "<script>window.alert('Vous ne pouvez pas vous self-ban');</script>";
    } else if ($_GET["role"] >= $_SESSION["role"]) {
        echo "<script>window.alert(\"Vous n'avez pas la permission\");</script>";
    } else {
        if($_GET["situation"] == 0){ $situation = 1; }
        else { $situation = 0 ; }
        $stmt = $db->prepare("UPDATE utilisateurs SET ban = ? WHERE id = ?");
        $stmt->execute([$situation, $_GET["ban"]]);
        header("Location: Users.php");
        exit();
    }
}

// Ban et unban

$stmt = $db->query("SELECT id, nom, prenom, email, role, ban FROM utilisateurs");
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des utilisateurs</title>
    <link rel="stylesheet" href="Users.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
            <th>Ban</th>
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
                    <span class="<?= $user["role"] >=1 ? 'role-admin' : 'role-user' ?>">
                        <?= $user["role"] >= 1 ? "Admin" : "Utilisateur" ?>
                    </span>
                </td>

                <td>
                    <a href="?ban=<?= $user["id"] ?>&perm=<?= $user["role"] ?>&situation=<?= $user["ban"] ?>"
                        onclick="return confirm('<?= $user['ban'] == 0 ? 'Ban' : 'Unban' ?> <?= htmlspecialchars($user['prenom']) ?> <?= htmlspecialchars($user['nom']) ?> ?')">
                        <button class="btn-supprimer" style="background: #2a4db5;">
                            <?php if($user["ban"]==0) { echo "Ban";} 
                                else { echo "Unban";} ?>
                        </button>
                    </a>
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

<a href="Admin_panel.php" class="btn btn-outline-secondary" id="admin">Admin panel</a>

</body>
</html>