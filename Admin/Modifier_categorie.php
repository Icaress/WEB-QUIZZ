<?php
require_once "../Configuration/config.php";
//require_once "../Configuration/Perm_verif.php";

$categories = $db->query("SELECT * FROM catégorie")->fetchAll(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $categories = $_POST["categorie_id"];
    $rename = trim($_POST["Rename"]);

    $stmt = $db->prepare("UPDATE catégorie SET nom = ? WHERE id = ?");
    $stmt->execute([$rename, $categories]);
    header("Location: Admin_panel.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Modifier_categorie.css">
    <script src='Modifier_categorie.js' defer></script>
    <title>Renommer une catégorie</title>
</head>
<body>
    <form action="Modifier_categorie.php" method="POST">
        <h1>Renommer un catégorie</h1>
        <select name="categorie_id" id='select_cat'required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <div id='question_input'>
            <label for="Rename">Renommer la catégorie "<span id="nom_cat"></span>"</label>
            <input type="text" name="Rename" placeholder='Renommer la catégorie sélectionner' required>
        </div>
        <input type="submit" value="Renommer">
    </form>
</body>
</html>