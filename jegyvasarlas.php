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
    <title>Kosárlabda.rs - Minden ami kosárlabda - Jegyvásárlás</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<?php

    if (isset($_GET['id_match']) AND isset($_GET['amount']) AND is_numeric($_GET['amount']) AND $_GET['amount'] > 0) {
        include_once ('db_config.php');
        global $connection;

        $id_match = $_GET['id_match'];
        $id_match = mysqli_real_escape_string($connection, $id_match);

        $amount = $_GET['amount'];
        $amount = mysqli_real_escape_string($connection, $amount);

        if(isset($_SESSION['cart']))
            $_SESSION['cart'][$id_match] += $amount;
        else
            $_SESSION['cart'][$id_match] = $amount;

        header('Location:add_to_cart.php');
        exit();
    }

?>
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
                <li class="active"><a href="jegyvasarlas.php">Jegyvásárlás</a></li>
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

<div class="container ticketorder wow slideInUp">
    <h1>Meccsjegyek vásárlási listája</h1>
</div>

<div class="table-responsive ticketrows wow slideInUp">
    <table class="table">
        <thead>
        <tr>
            <th>Meccs neve</th>
            <th>Helyszín neve</th>
            <th>Dátum és idő</th>
            <th>Meccs ára</th>
            <th>Meccs leírás</th>
            <th>Jegyek száma / Vásárlás</th>
        </tr>
        </thead>
        <?php
            include('db_config.php');
            global $connection;

            $sql = "SELECT id_match, match_name, name_of_venue, datetime, price, match_description FROM matches";

            $result = mysqli_query($connection, $sql) or die($connection);

            if (mysqli_num_rows($result) > 0) {
                while ($record = mysqli_fetch_array($result)) {
                    ?>
                    <tbody>
                    <tr>
                        <td><?php echo $record['match_name']; ?></td>
                        <td><?php echo $record['name_of_venue']; ?></td>
                        <td><?php echo $record['datetime']; ?></td>
                        <td><?php echo $record['price']; ?> din.</td>
                        <td><?php echo $record['match_description']; ?></td>
                        <td>
                            <form method="get" action="" class="form-inline">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="amount" />
                                </div>
                                <div class="form-group">
                                    <input type="hidden" class="form-control" name="id_match" value="<?php echo $record['id_match']?>" />
                                </div>
                                <button type="submit" class="btn btn-default">Vásárlás</button>
                            </form>
                        </td>
                    </tr>
                    </tbody>
        <?php
                }
            }
        ?>
        <tfoot>
        <tr>
            <td colspan="8">Összesen: <?php echo mysqli_num_rows($result); ?></td>
        </tr>
        </tfoot>
    </table>
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