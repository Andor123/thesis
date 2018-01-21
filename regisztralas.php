<?php
session_start();
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
                <li class="active"><a href="regisztralas.php">Regisztrálás/bejelentkezés</a></li>
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

<div class="container registration wow slideInUp">
    <h1>Regisztrálás</h1>
    <form method="post" action="register.php" class="form-inline">
        <div class="form-group">
            <label for="lastname">Vezetéknév:</label><br />
            <input type="text" class="form-control" id="lastname" name="lastname" />
        </div><br /><br />
        <div class="form-group">
            <label for="firstname">Keresztnév:</label><br />
            <input type="text" class="form-control" id="firstname" name="firstname" />
        </div><br /><br />
        <div class="form-group">
            <label for="email">Email:</label><br />
            <input type="email" class="form-control" id="email" name="email" />
        </div><br /><br />
        <div class="form-group">
            <label for="password">Jelszó:</label><br />
            <input type="password" class="form-control" id="password" name="password" />
        </div><br /><br />
        <button type="submit" class="btn btn-default">Regisztrálok</button>
        <button type="reset" class="btn btn-default">Mégse</button>
    </form>
</div>

<div class="container signin wow slideInUp">
    <h1>Bejelentkezés</h1>
    <form method="post" action="signin.php" class="form-inline">
        <div class="form-group">
            <label for="email2">Email:</label><br />
            <input type="email" class="form-control" id="email2" name="email" />
        </div><br /><br />
        <div class="form-group">
            <label for="password2">Jelszó:</label><br />
            <input type="password" class="form-control" id="password2" name="password" />
        </div><br /><br />
        <button type="submit" class="btn btn-default">Bejelentkezek felhasználóként</button>
        <button type="reset" class="btn btn-default">Mégse</button>
    </form>
</div>

<div class="container forgotten-password wow slideInUp">
    <h1>Elfelejtett jelszó</h1>
    <form method="post" action="forgot.php" class="form-inline">
        <div class="form-group">
            <label for="email3">Email:</label><br />
            <input type="email" class="form-control" id="email3" name="email" />
        </div><br /><br />
        <button type="submit" class="btn btn-default">E-mail küldése</button>
        <button type="reset" class="btn btn-default">Mégse</button>
    </form>
</div>

<div class="container admin wow slideInUp">
    <h1>Admin regisztrálása</h1>
    <form method="post" action="admin.php" class="form-inline">
        <div class="form-group">
            <label for="name">Admin felhaszálónév:</label><br />
            <input type="text" class="form-control" id="name" name="name" />
        </div><br /><br />
        <div class="form-group">
            <label for="password3">Jelszó:</label><br />
            <input type="password" class="form-control" id="password3" name="password" />
        </div><br /><br />
        <button type="submit" class="btn btn-default">Regisztrálok</button>
        <button type="reset" class="btn btn-default">Mégse</button>
    </form>
</div>

<div class="container admin_login wow slideInUp">
    <h1>Admin bejelentkezése</h1>
    <form method="post" action="admin_login.php" class="form-inline">
        <div class="form-group">
            <label for="name2">Admin felhaszálónév:</label><br />
            <input type="text" class="form-control" id="name2" name="name" />
        </div><br /><br />
        <div class="form-group">
            <label for="password4">Jelszó:</label><br />
            <input type="password" class="form-control" id="password4" name="password" />
        </div><br /><br />
        <button type="submit" class="btn btn-default">Bejelentkezek adminként</button>
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