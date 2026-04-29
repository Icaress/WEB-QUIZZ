<?php
/* debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require_once '../Configuration/config.php';
//require_once '../Configuration/Perm_verif.php';

$categories = $db->query("SELECT * FROM catégorie")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $question = trim($_POST["Question"]);
    $reponse1 = trim($_POST["Reponse1"]);
    $reponse2 = trim($_POST["Reponse2"]);
    $reponse3 = trim($_POST["Reponse3"]);
    $reponse4 = trim($_POST["Reponse4"]);
    $B_reponse = $_POST["BonneRep"];
    $categorie = $_POST["categorie_id"];
    
    $check = $db->prepare("SELECT * FROM questions WHERE question=?");
    $check->execute([$question]);
    $exists = $check->fetch(PDO::FETCH_ASSOC);

    if($exists){
        echo "Question déjà crée";
    }
    else{
        $stmt = $db->prepare("INSERT INTO questions(question, reponse1, reponse2, reponse3, reponse4, bonne_reponse, catégorie) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$question, $reponse1, $reponse2, $reponse3, $reponse4, $B_reponse, $categorie]);
        header("Location: Admin_panel.php");
    }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crée une questions</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="Create_question.css">
</head>
<body>
    <form action="Create_question.php" method="post">
        <h1>Crée ta question</h1>
        <div class="question_input">
            <label for="Question">Question</label>
            <input type="text" name="Question" placeholder="Question à saisir" required>
        </div>
        <div class="question_input">
            <label for="Reponse1">Réponse 1</label>
            <input type="text" name="Reponse1" placeholder="Réponse 1 à saisir" required >
        </div>
        <div class="question_input">
            <label for="Reponse2">Réponse 2</label>
            <input type="text" name="Reponse2" placeholder="Réponse 2 à saisir" required>
        </div>
        <div class="question_input">
            <label for="Reponse3">Réponse 3</label>
            <input type="text" name="Reponse3" placeholder="Réponse 3 à saisir" required>
        </div>
        <div class="question_input">
            <label for="Reponse4">Réponse 4</label>
            <input type="text" name="Reponse4" placeholder="Réponse 4 à saisir" required>
        </div>
        <div class="question_input">
            <label for="BonneRep">Bonne Réponse</label>
            <input type="number" name="BonneRep" min="1" max="4" step="1" required>
        </div>
        <label for="categorie_id" id="lab">Veuillez saisir la catégorie de la question</label>
        <select name="categorie_id" required>
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['nom'] ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Crée la question">
    </form>

    
</body>
</html>