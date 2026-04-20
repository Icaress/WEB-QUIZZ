<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="footer/footer.css">
</head>

<header>
    <?php include "navbar.html" ?>
</header>

<body>
    <div class="text-center m-3 p-4 rounded-5" id="desc">
        <div class="d-inline-block px-5 rounded-5">
            <p>Informatique & Tech</p>
        </div>
        <br>
        <p class="p1">Teste tes connaissances </p>
        <br>
        <p>Des questions sur le web, les bases de données, les algorithmes et plus encore.</p>
        <br>
        <button type="submit" class="btn">Commencer le quiz</button>
    </div>
</body>

<footer>
    <?php include "footer/footer.html" ?>
</footer>

</html>