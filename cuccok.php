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
    <title>Kosárlabda.rs - Minden ami kosárlabda - Kosárlabdás cuccok</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/index.css" rel="stylesheet">
</head>
<?php

    if (isset($_GET['id_merchandise']) AND isset($_GET['amount']) AND is_numeric($_GET['amount']) AND $_GET['amount'] > 0) {
        include_once ('db_config.php');
        global $connection;

        $id_merchandise = $_GET['id_merchandise'];
        $id_merchandise = mysqli_real_escape_string($connection, $id_merchandise);

        $amount = $_GET['amount'];
        $amount = mysqli_real_escape_string($connection, $amount);

        if(isset($_SESSION['product']))
            $_SESSION['product'][$id_merchandise] += $amount;
        else
            $_SESSION['product'][$id_merchandise] = $amount;

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
                <li><a href="jegyvasarlas.php">Jegyvásárlás</a></li>
                <li class="active"><a href="cuccok.php">Kosárlabdás cuccok</a></li>
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

<div class="container basketball wow slideInUp">
    <h1>Kosárlabdás cuccok</h1>
    <?php
    include('db_config.php');
    global $connection;

    $sql = "SELECT id_merchandise, picture, merchandise_name, price, merchandise_description FROM merchandise WHERE active='1'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result)) {
        while ($record = mysqli_fetch_array($result)) {
            ?>
            <div class="container stuff col-lg-4 col-md-4 col-sm-4 col-xs-4">
                <img src="images/<?php echo $record['picture']; ?>" alt="image" class="img-responsive" />
                <p>Termék neve: <?php echo $record['merchandise_name']; ?></p>
                <p>Ára: <?php echo $record['price']; ?> din.</p>
                <p>Leírás: <br /><?php echo $record['merchandise_description']; ?></p>
                <form method="get" action="" class="form-inline">
                    <div class="form-group">
                        <label>Hány darabot szeretnél?:</label><br />
                        <input type="text" class="form-control" name="amount" />
                    </div><br /><br />
                    <div class="form-group">
                        <input type="hidden" class="form-control" name="id_merchandise" value="<?php echo $record['id_merchandise'] ?>">
                    </div>
                    <button type="submit" class="btn btn-default">Vásárlás</button>
                </form>
            </div>
    <?php
        }
    }
    ?>
</div>

<div class="container comments wow slideInUp" id="comments">
    <h1>Kommentek az árúra</h1>
    <form method="post" action="komment.php">
        <div class="form-group">
            <label>Termék neve:</label><br />
            <select id="comment_brand" name="comment_brand">
                <option value=""></option>
                <?php
                $sql = "SELECT merchandise_name FROM merchandise";
                $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row['merchandise_name'] ?>"><?php echo $row['merchandise_name'] ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Komment:</label>
            <textarea class="form-control" rows="5" id="comment" name="comment"></textarea>
        </div>
        <button type="submit" class="btn btn-default">Küldés</button>
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