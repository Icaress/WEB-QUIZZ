<?php

require_once "../Configuration/config.php";
require_once "../Configuration/Perm_verif.php";

$cooldown_db = (int)$db->query("SELECT time FROM timer")->fetchColumn();

if(isset($cooldown_db)){
    $hr = str_pad(floor($cooldown_db / 3600), 2, "0", STR_PAD_LEFT);
    $min = str_pad(floor(($cooldown_db % 3600) / 60), 2, "0", STR_PAD_LEFT);
    $sec = str_pad($cooldown_db % 60, 2, "0", STR_PAD_LEFT);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $time = explode(":", $_POST["cooldown"]); // ["HH", "MM", "SS"]
    $seconds = ($time[0] * 3600) + ($time[1] * 60) + $time[2];

    $db->prepare("UPDATE timer SET time = ?")->execute([$seconds]);
    header("Location: #");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Modifier_timer.css">
</head>
<body>

    <div class="d-flex flex-column align-items-center justify-content-center">
        <h1 class="fst-italic"><strong>Modifier la durée d'une tentative</strong></h1>
        <p>Durée d'une tentative : <?= $hr.":".$min.":".$sec ?></p>
        
        <form action="" method="post">
            <label for="cooldown">Modifier : </label>
            <input type="time" name="cooldown" step="1" id="cooldown">
            <button type="submit">Confirm</button>
        </form>

        <a href="Admin_panel.php" class="btn btn-outline-secondary mt-4" id="admin">Admin panel</a>

    </div>

</body>
</html>