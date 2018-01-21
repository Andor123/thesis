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
    <title>Kosárlabda.rs - Minden ami kosárlabda - Vásárlás</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-default">
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

<div class="container cart wow slideInUp">
    <h1>Megvásárolandó jegyek/termékek</h1>
    <?php

    if (isset($_GET['id_match']) AND isset($_GET['new_amount']) AND is_numeric($_GET['new_amount']) AND $_GET['new_amount'] > 0) {
        include_once ('db_config.php');
        global $connection;

        $id_match = $_GET['id_match'];
        $id_match = mysqli_real_escape_string($connection, $id_match);

        $new_amount = $_GET['new_amount'];
        $new_amount = mysqli_real_escape_string($connection, $new_amount);

        $_SESSION['cart'][$id_match] = $new_amount;
    }


    if (isset($_GET['id_merchandise']) AND isset($_GET['new_amount']) AND is_numeric($_GET['new_amount']) AND $_GET['new_amount'] > 0) {
        include_once ('db_config.php');
        global $connection;

        $id_merchandise = $_GET['id_merchandise'];
        $id_merchandise = mysqli_real_escape_string($connection, $id_merchandise);

        $new_amount = $_GET['new_amount'];
        $new_amount = mysqli_real_escape_string($connection, $new_amount);

        $_SESSION['product'][$id_merchandise] = $new_amount;
    }

    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        include_once('db_config.php');
        global $connection;
        foreach ($_SESSION['cart'] as $k => $v) {
            $sql = "SELECT match_name, price  FROM matches WHERE id_match = '$k'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result)) {
                    ?>
                    <p>Meccs neve: <?php echo $record['match_name']?></p>
                    <p>Összár: <?php echo $v*$record['price']?> din.</p>
                    <form method="get" action="" class="form-inline">
                        <div class="form-group">
                            <label>Ha szeretnél változtatni a darabszámon, akkor itt lehet megtenni:</label><br />
                            <input type="text" class="form-control" name="new_amount" value="<?php echo $v ?>" />
                        </div><br /><br />
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_match" value="<?php echo $k?>" />
                        </div>
                    <button type="submit" class="btn btn-default">Módosítás</button>
                    <a class="btn btn-default glyphicon glyphicon-remove" href="delete_cart.php?id_match=<?php echo $k ?>"></a>
                    </form>
    <?php

                }
            }
            $_SESSION['cart'][$k] = $v;
        }
    }

    if (isset($_SESSION['product']) && is_array($_SESSION['product'])) {
        include_once('db_config.php');
        global $connection;
        foreach ($_SESSION['product'] as $k => $v) {
            $sql = "SELECT merchandise_name, price  FROM merchandise WHERE id_merchandise = '$k'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result)) {
                    ?>
                    <p>Termék neve: <?php echo $record['merchandise_name']?></p>
                    <p>Összár: <?php echo $v*$record['price']?> din.</p>
                    <form method="get" action="" class="form-inline">
                        <div class="form-group">
                            <label>Ha szeretnél változtatni a darabszámon, akkor itt lehet megtenni:</label><br />
                            <input type="text" class="form-control" name="new_amount" value="<?php echo $v ?>" />
                        </div><br /><br />
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_merchandise" value="<?php echo $k?>" />
                        </div>
                    <button type="submit" class="btn btn-default">Módosítás</button>
                    <a class="btn btn-default glyphicon glyphicon-remove" href="delete_cart.php?id_merchandise=<?php echo $k ?>"></a>
                    </form>
                    <?php

                }
            }
            $_SESSION['product'][$k] = $v;
        }
    }
    ?>
    <br /><br />
    <a class="btn btn-default" href="vasarlas.php">Vásárlás</a>
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
