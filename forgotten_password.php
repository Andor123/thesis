<?php
session_start();

if (isset($_GET['forgotten_code']) && isset($_GET['id'])) {

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Kosárlabda.rs - Az oldal, ahol a legjobb kosárlabdás dolgok találhatók egy helyen.">
        <meta name="keywords" content="Kosárlabda,jegyek,cuccok,meccsek,kommentárok">
        <meta name="author" content="Salamon Andor">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kosárlabda.rs - Minden ami kosárlabda - Regisztrálás/Bejelentkezés</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/index.css" rel="stylesheet">
    </head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-header" href=""><img alt="kosarlabda" src="images/kosárlabda.png" class="img-responsive" /></a>
        </div>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Főoldal</a></li>
                <li><a href="meccsek.php">Meccsek</a></li>
                <li><a href="jegyvasarlas.php">Jegyvásárlás</a></li>
                <li><a href="cuccok.php">Kosárlabdás cuccok</a></li>
                <li><a href="regisztralas.php">Regisztrálás/bejelentkezés</a></li>
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                    <li><a href="logout_user.php">Felhasználó kijelentkezés</a></li>
                    <?php
                }
                if (isset($_SESSION['admin'])) {
                    ?>
                    <li><a href="rendelesek.php">Rendelések listája</a></li>
                    <li><a href="logout_admin.php">Admin kijelentkezés</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

    <div class="container forgotten-password wow slideInUp">
        <h1>Elfelejtett jelszó</h1>
        <form method="post" action="new_password.php" class="form-inline">
            <div class="form-group">
                <label for="password">Új jelszó:</label><br />
                <input type="password" class="form-control" id="password" name="password" />
            </div><br /><br />
            <button type="submit" class="btn btn-default">Jelszó megváltoztatása</button>
            <button type="reset" class="btn btn-default">Mégse</button>
        </form>
    </div>

<footer class="footer">
    <div class="container">
        <p class="text-center">&copy;2017 Kosárlabda.rs</p>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
</body>
</html>
    <?php

}

?>