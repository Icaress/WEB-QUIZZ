<?php
require_once '../Configuration/config.php';

$categories = $db->query("SELECT * FROM catégorie")->fetchAll(PDO::FETCH_ASSOC);


$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM questions WHERE id = ?");
$stmt->execute([$id]);
$question = $stmt->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $q = trim($_POST['question']);
    $r1 = trim($_POST['reponse1']);
    $r2 = trim($_POST['reponse2']);
    $r3 = trim($_POST['reponse3']);
    $r4 = trim($_POST['reponse4']);
    $br = $_POST['bonne_reponse'];

    $stmt = $db->prepare("UPDATE questions SET question=?, reponse1=?, reponse2=?, reponse3=?, reponse4=?, bonne_reponse=?, catégorie=? WHERE id=?");
    $stmt->execute([$q, $r1, $r2, $r3, $r4, $br, $_POST['categorie_id'], $id]);
    header("Location: Admin_panel.php");
    exit();
}
?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Modifier_Question.css">
    <title>Modifier une question</title>
</head>
<body>
    <h1>Modifier votre question</h1>
   <form method="POST">
        <label for="question">Nouvelle question :</label>
        <input type="text" name="question" value="<?= $question['question'] ?>">
        <label for="reponse1">Nouvelle Réponse 1 :</label>
        <input type="text" name="reponse1" value="<?= $question['reponse1'] ?>">
        <label for="reponse2">Nouvelle Réponse 2 :</label>
        <input type="text" name="reponse2" value="<?= $question['reponse2'] ?>">
        <label for="reponse3">Nouvelle Réponse 3 :</label>
        <input type="text" name="reponse3" value="<?= $question['reponse3'] ?>">
        <label for="reponse4">Nouvelle Réponse 4 :</label>
        <input type="text" name="reponse4" value="<?= $question['reponse4'] ?>">
        <label for="bonne_reponse">Bonne réponse :</label>
        <input type="number" name="bonne_reponse" value="<?= $question['bonne_reponse'] ?>">
        <label>Catégorie</label>
        <select name="categorie_id">
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= $cat['id'] == $question['catégorie'] ? 'selected' : '' ?>>
                    <?= $cat['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>