<?php
require_once "../Configuration/config.php";
require_once "../Configuration/Perm_verif.php";

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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

        <a href="Admin_panel.php" class="btn btn-outline-secondary" id="admin">Admin panel</a>

    </form>
    
</body>
</html>