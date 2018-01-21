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
<?php
if (isset($_SESSION['user'])) {
    include_once ('db_config.php');
    global $connection;

    $user = $_SESSION['user'];
    $user = mysqli_real_escape_string($connection, $user);

    $sql = "SELECT id_user FROM users WHERE first_name = '$user'";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    $row = mysqli_fetch_array($result);
}

if (isset($_SESSION['admin'])) {
    include_once ('db_config.php');
    global $connection;

    $admin = $_SESSION['admin'];
    $admin = mysqli_real_escape_string($connection, $admin);

    $sql2 = "SELECT id_admin FROM admin WHERE admin_name = '$admin'";
    $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));
    $row2 = mysqli_fetch_array($result2);
}

$id = $row['id_user'];
$id2 = $row2['id_admin'];

if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($_SESSION['user'])) {
    foreach ($_SESSION['cart'] as $k => $v) {
        include_once ('db_config.php');
        global $connection;

        $sql = "INSERT INTO tickets (id_user, id_match, amount, datetime) VALUES ('$id', '$k', '$v', now())";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }
}
if (isset($_SESSION['product']) && is_array($_SESSION['product']) && isset($_SESSION['user'])) {
    foreach ($_SESSION['product'] as $k => $v) {
        include_once ('db_config.php');
        global $connection;

        $sql = "INSERT INTO products (id_user, id_merchandise, amount, datetime) VALUES ('$id', '$k', '$v', now())";
        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }
}

if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
    include_once('db_config.php');
    global $connection;

    $numbers = '0123456789';

    $length = 8;
    $down = 0;
    $up = strlen($numbers) - 1;
    $i = 0;
    $ref_number = '';

    while ($i < $length) {
        $number = $numbers{mt_rand($down, $up)};

        $ref_number .= $number;

        $i++;
    }

    $sql = "INSERT INTO orders (id_admin, id_user, reference_number) VALUES ('$id2', '$id', '$ref_number')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}
?>
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
    <h1>Kosár Tartalma</h1>
    <?php
    if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        include_once('db_config.php');
        global $connection;

        foreach ($_SESSION['cart'] as $k => $v) {
            $sql = "SELECT match_name, price FROM matches WHERE id_match = '$k'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            $sql2 = "SELECT id_ticket FROM tickets WHERE id_match = '$k'";
            $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

            $sql3 = "SELECT id_order FROM orders WHERE id_user = '$id' AND id_admin = '$id2'";
            $result3 = mysqli_query($connection, $sql3) or die(mysqli_error($connection));

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result)) {
                    ?>
                    <p>Meccs neve: <?php echo $record['match_name'] ?></p>
                    <p>Összár: <?php echo $v * $record['price'] ?> din.</p>
                    <?php
                }
            }
            if (mysqli_num_rows($result2) > 0) {
                while ($record2 = mysqli_fetch_array($result2)) {
                    $_SESSION['id_ticket'] = $record2['id_ticket'];
                }
            }
            if (mysqli_num_rows($result3) > 0) {
                while ($record3 = mysqli_fetch_array($result3)) {
                    $_SESSION['id_order'] = $record3['id_order'];
                }
            }
            $_SESSION['cart'][$k] = $v;
        }
    }
    if (isset($_SESSION['product']) && is_array($_SESSION['product'])) {
        include_once('db_config.php');
        global $connection;

        foreach ($_SESSION['product'] as $k => $v) {
            $sql = "SELECT merchandise_name, price FROM merchandise WHERE id_merchandise = '$k'";
            $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

            $sql2 = "SELECT id_product FROM products WHERE id_merchandise = '$k'";
            $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

            $sql3 = "SELECT id_order FROM orders WHERE id_user = '$id' AND id_admin = '$id2'";
            $result3 = mysqli_query($connection, $sql3) or die(mysqli_error($connection));


            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result)) {
                    ?>
                    <p>Termék neve: <?php echo $record['merchandise_name']?></p>
                    <p>Összár: <?php echo $v*$record['price']?> din.</p>
                    <?php

                }
            }
            if (mysqli_num_rows($result2) > 0) {
                while ($record2 = mysqli_fetch_array($result2)) {
                    $_SESSION['id_product'] = $record2['id_product'];
                }
            }
            if (mysqli_num_rows($result3) > 0) {
                while ($record3 = mysqli_fetch_array($result3)) {
                    $_SESSION['id_order'] = $record3['id_order'];
                }
            }
            $_SESSION['product'][$k] = $v;
        }
    }
    ?>
    <br /><br />
    <a class="btn btn-default" href="email.php">E-mail küldése</a>
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
