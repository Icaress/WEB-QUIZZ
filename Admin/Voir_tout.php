<?php
require_once "../Configuration/config.php";
require_once '../Configuration/Perm_verif.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
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
            <summary><?= htmlspecialchars($q['question']) ?></summary>
            <p>Réponse 1 : <?= htmlspecialchars($q['reponse1']) ?></p>
            <p>Réponse 2 : <?= htmlspecialchars($q['reponse2']) ?></p>
            <p>Réponse 3 : <?= htmlspecialchars($q['reponse3']) ?></p>
            <p>Réponse 4 : <?= htmlspecialchars($q['reponse4']) ?></p>
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

<a href="Admin_panel.php" class="btn btn-outline-secondary" id="admin">Admin panel</a>

</body>
</html>