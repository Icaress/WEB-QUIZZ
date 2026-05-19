<?php

require_once "../Configuration/config.php";

if(isset($_SESSION["cooldown"])){
    $cooldown_db = $_SESSION["cooldown"];
    $hr = str_pad(floor($cooldown_db / 3600), 2, "0", STR_PAD_LEFT);
    $min = str_pad(floor(($cooldown_db % 3600) / 60), 2, "0", STR_PAD_LEFT);
    $sec = str_pad($cooldown_db % 60, 2, "0", STR_PAD_LEFT);
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $time = explode(":", $_POST["cooldown"]); // ["HH", "MM", "SS"]
    $seconds = ($time[0] * 3600) + ($time[1] * 60) + $time[2];

    $db->prepare("UPDATE timer SET time = ?")->execute([$seconds]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div><p>The current cooldown is : <?= $hr.":".$min.":".$sec ?></p></div>
    
    <form action="" method="post">
        <label for="cooldown">Modify : </label>
        <input type="time" name="cooldown" step="1" id="cooldown">
        <button type="submit">Confirm</button>
    </form>

</body>
</html>