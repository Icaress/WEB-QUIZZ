<?php
require_once "../Configuration/config.php";
//require_once '../Configuration/Perm_verif.php';

$categories = $db->query("SELECT * FROM catégorie")->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['delete'])){
    $stmt = $db->prepare("DELETE FROM questions WHERE id = ?");
    $stmt->execute([$_POST['delete_id']]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toutes les catégories et questions</title>
    <link rel="stylesheet" href="Voir_tout.css">
</head>
<body>
    <form method="GET">
        <h1>Sélectionner une catégorie</h1>
        <select name="categorie_id" onchange="this.form.submit()">
            <option value="">-- Choisir une catégorie --</option>
            <?php foreach($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>" <?= isset($_GET['categorie_id']) && $_GET['categorie_id'] == $cat['id'] ? 'selected' : '' ?>><?= $cat['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </form>

<?php if(isset($_GET['categorie_id']) && $_GET['categorie_id'] != ''): ?>
    <?php
    $stmt = $db->prepare("SELECT * FROM questions WHERE catégorie = ?");
    $stmt->execute([$_GET['categorie_id']]);
    $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <?php foreach($questions as $q): ?>
        <details>
            <summary><?= $q['question'] ?></summary>
            <p>Réponse 1 : <?= $q['reponse1'] ?></p>
            <p>Réponse 2 : <?= $q['reponse2'] ?></p>
            <p>Réponse 3 : <?= $q['reponse3'] ?></p>
            <p>Réponse 4 : <?= $q['reponse4'] ?></p>
            <p>Bonne réponse : <?= $q['bonne_reponse'] ?></p>

            <div class="actions">
                <form method="POST">
                    <input type="hidden" name="delete_id" value="<?= $q['id'] ?>">
                    <button type="submit" name="delete">Supprimer</button>
                </form>
                <a href="Modifier_Question.php?id=<?= $q['id'] ?>">Modifier</a>
            </div> 
        </details>

        <?php endforeach; ?>
<?php endif; ?>
</body>
</html>