<?php
require_once '../Configuration/config.php';
require_once '../Configuration/Perm_verif.php';

if($_SERVER["REQUEST_METHOD"] = "POST"){
    $nom = trim($_POST["nom"]);
    
    $check = $db->prepare("SELECT * FROM categorie WHERE nom=?");
    $check->execute([$nom]);
    $exists = $check->fetch(PDO::FETCH_ASSOC);

    if ($exists) {
        echo "Nom déjà utilisé";
    } else {    
        $stmt = $db->prepare("INSERT INTO categorie(nom) VALUES (?)");
        $stmt->execute([$nom]);
        header("Location: Admin_panel.php");
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <title>Crée une catégorie</title>
</head>
<body>
    <form action="Create_categorie.php" method="post">
        <div id='nom_catégorie'>
            <label for="nom">Nom de la catégorie</label>
            <input type="text" name='nom' placeholder='Nom de la catégorie'>
        </div>
        <input type="submit" value='Crée une catégorie'>
    </form>
</body>
</html>