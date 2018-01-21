<?php
session_start();
include('db_config.php');
global $connection;

$sql = "SELECT datetime FROM users WHERE active = '0'";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$date = $row['datetime'];
$time = strtotime($date);
$time_diff = time() - $time;

if ($time_diff > 86400) {
    $sql = "UPDATE users SET active = '1' WHERE datetime = '$date'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "UPDATE users SET active = '1' WHERE activation_code = '$id'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Kosárlabda.rs - Az oldal, ahol a legjobb kosárlabdás dolgok találhatók egy helyen.">
    <meta name="keywords" content="Kosárlabda,jegyek,cuccok,meccsek,kommentárok">
    <meta name="author" content="Salamon Andor">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kosárlabda.rs - Minden ami kosárlabda - Főoldal</title>
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
                <li class="active"><a href="index.php">Főoldal</a></li>
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

<div class="container main wow slideInUp" id="main">
    <h1>Üdvözlünk mindenkit az oldalon!</h1>
    <p class="lead">Ezt az oldalt azért hoztuk létre, hogy mindekinek legyen kedve a kosárlabdás cuccokhoz, meccsekre jegyet venni, kommentálni a látott meccseket vagy csak otthonról nézni őket.</p>
    <a href='#main2' class="btn btn-lg btn-default">További infó</a>
</div>

<div class="container tickets wow slideInUp" id="tickets">
    <h1>Vegyél nálunk jegyeket!</h1>
    <p class="lead">Mindig jó érzés, ha valaki élőben szeretné megnézni a meccseket, ezért gondoltunk arra, hogy itt lehet a legjobb áron venni jegyet a meccsekre.</p>
    <a href="#tickets2" class="btn btn-lg btn-default">További infó</a>
</div>

<div class="container merchandise wow slideInUp" id="merchandise">
    <h1>Öltöztesd be magad a legjobb cuccokba!</h1>
    <p class="lead">Mindig megéri megvenni a legújabb kosárlabda mezeket, cipőket, táskákat és minden olyan dolgot, ami a kosárlabdáról szól.</p>
    <a href="#merchandise2" class="btn btn-lg btn-default">További infó</a>
</div>

<div class="container services wow slideInUp">
    <h1>Főbb szolgáltatásaink</h1>
    <div id="main2">
        <h2>Kommentálás az eseményekre</h2>
        <p class="lead">A regisztrált felhasználóink számára van ez a rész fentartva, ugyanis fontosnak tartjuk a visszajelzéseket egy-egy mérközéssel kapcsolatban.</p>
        <a href="#main" class="btn btn-default">Vissza az elejére</a>
    </div>
    <div id="tickets2">
        <h2>Jegyvásárlás</h2>
        <p class="lead">Jegyvásárlás esetén az ügyvelünk egyszere több jegyet is vásárolhat és ezeket az adminisztrátoraink egyike fogja majd érvényesíteni a hivatkozási számra hivatkozva.</p>
        <a href="#tickets" class="btn btn-default">Vissza az elejére</a>
    </div>
    <div id="merchandise2">
        <h2>Ruhavásárlás</h2>
        <p class="lead">Ruházat vásárlása esetén is ugyanaz a teendő, mint jegyvásárlás esetén is, vagyis annyit vehetnek, amennyit akarnak és az adminisztrátorok hitelesítik azt.</p>
        <a href="#merchandise" class="btn btn-default">Vissza az elejére</a>
    </div>
</div>

<div class="container col-md-6 col-lg-6 col-xs-6 button1 wow slideInUp">
    <a href="meccsek.php" class="btn btn-default">Meccsek</a>
</div>
<div class="container col-md-6 col-lg-6 col-xs-6 button2 wow slideInUp">
    <a href="jegyvasarlas.php" class="btn btn-default">Jegyvásárlás</a>
</div>
<div class="container col-md-6 col-lg-6 col-xs-6 button3 wow slideInUp">
    <a href="cuccok.php" class="btn btn-default">Kosárlabdás cuccok</a>
</div>
<div class="container col-md-6 col-lg-6 col-xs-6 button4 wow slideInUp">
    <a href="cuccok.php#comments" class="btn btn-default">Kommentárok</a>
</div>

<div class="container features wow slideInUp">
    <h1>Érdekességek</h1>
    <h2>Felhasználók száma</h2>
    <?php
        $sql = "SELECT * FROM users WHERE active = '1'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        ?>
        <p class="lead"><?php echo mysqli_num_rows($result); ?></p>
        <a href="regisztralas.php" class="btn btn-default">További infó</a>
        <h2>Adminok száma</h2>
        <?php
        $sql = "SELECT * FROM admin";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        ?>
        <p class="lead"><?php echo mysqli_num_rows($result); ?></p>
        <a href="regisztralas.php" class="btn btn-default">További infó</a>
        <h2>Jegy megvásárolva</h2>
        <?php
        $sql = "SELECT * FROM orders_cart";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        ?>
        <p class="lead"><?php echo mysqli_num_rows($result); ?></p>
        <a href="jegyvasarlas.php" class="btn btn-default">További infó</a>
        <h2>Öltözet megvásárolva</h2>
        <?php
        $sql = "SELECT * FROM orders_products";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        ?>
        <p class="lead"><?php echo mysqli_num_rows($result); ?></p>
        <a href="cuccok.php" class="btn btn-default">További infó</a>
</div>

<div class="container sponsors wow slideInUp">
    <h1>Szponzorok</h1>
    <h2>National Basketball Association (NBA)</h2>
    <img alt="nba" src="images/i.png" class="img-responsive center-block" /><br />
    <a href="http://www.nba.com/" class="btn btn-default">További infó</a>
    <h2>Euroleague Basketball</h2>
    <img alt="euroleague" src="images/tae-logo-black-vertical.png" class="img-responsive center-block" /><br />
    <a href="http://www.euroleague.net/" class="btn btn-default">További infó</a>
    <h2>Nemzetközi Kosárlabda Szövetség (FIBA)</h2>
    <img alt="fiba" src="images/logo_fiba.png" class="img-responsive center-block" /><br />
    <a href="http://www.fiba.com/" class="btn btn-default">További infó</a>
    <h2>Spalding</h2>
    <img alt="spalding" src="images/a74e2daaf8270450c649ee4dcb74b452.jpg" class="img-responsive center-block" /><br />
    <a href="https://www.spalding.com/" class="btn btn-default">További infó</a>
    <h2>Peak Sport</h2>
    <img alt="peak" src="images/logo.png" class="img-responsive center-block" /><br />
    <a href="http://www.peaksportsusa.com/" class="btn btn-default">További infó</a>
    <h2>Adidas</h2>
    <img alt="adidas" src="images/Adidas_Logo.svg.png" class="img-responsive center-block" /><br />
    <a href="http://www.adidas.hu/" class="btn btn-default">További infó</a>
    <h2>Nike</h2>
    <img alt="nike" src="images/apple-touch-icon.png" class="img-responsive center-block" /><br />
    <a href="http://www.nike.com/hu/hu_hu/?ref=https%253A%252F%252Fwww.google.rs%252F" class="btn btn-default">További infó</a>
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