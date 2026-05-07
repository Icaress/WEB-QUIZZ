<?php 

date_default_timezone_set('Europe/Paris');

require "../Configuration/config.php";

if(isset($_GET["tentative_id"])){

    $tentative_id = $_GET["tentative_id"];

    // prendre les questions avec réponses 
    $temp = $db->prepare("SELECT questions.question, questions.reponse1, questions.reponse2, questions.reponse3, questions.reponse4, reponses.correcte, reponses.reponse_utilisateur
                            FROM reponses
                            JOIN questions ON questions.id = reponses.question_id
                            WHERE reponses.tentative_id = ?
                            ");
    $temp->execute([$tentative_id]);
    $results = $temp->fetchAll();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../footer/footer.css">
</head>
<body>

<div>

    <?php foreach($results as $result){ ?>
        <div>
            <h2><?= htmlspecialchars($result["question"]) ?></h2>
            <p><?= htmlspecialchars($result["reponse1"]) ?></p>
            <p><?= htmlspecialchars($result["reponse2"]) ?></p>
            <p><?= htmlspecialchars($result["reponse3"]) ?></p>
            <p><?= htmlspecialchars($result["reponse4"]) ?></p>
        </div>
        <br>
    <?php } ?>

</div>

</body>

<footer>
    <?php include "../footer/footer.html" ?>
</footer>

</html>