<?php 

session_start();
require "../Configuration/config.php";

if(isset($_GET["catégorie"])){
    $catégorie = 
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
    <script src='../Fonction/show.js'></script>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="../footer/footer.css">
</head>

<header>
    <?php require "../navbar/navbar.php"; ?>
</header>

<body>
        
    <button onclick="show('1')" class="btn">1</button>

    <?php 
    
    $questions = $db->prepare("SELECT * FROM questions WHERE catégorie = ? ");

    while () {
        echo "";
    }
    
    ?>

</body>

<footer>
    <?php require "../footer/footer.html"; ?>
</footer>

</html>