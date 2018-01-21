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
    <title>Kosárlabda.rs - Minden ami kosárlabda - Admin Felület</title>
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
                <?php
                if (isset($_SESSION['admin'])) {
                    ?>
                    <li><a href="rendelesek.php">Rendelések listája</a></li>
                    <li><a href="admin_meccsek.php">Meccsek listája</a></li>
                    <li><a href="admin_termekek.php">Termékek listája</a></li>
                    <li><a href="admin_user.php">Felhasználók listája</a></li>
                    <li><a href="logout_admin.php">Admin kijelentkezés</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container orders wow slideInUp">
    <h1>Termék módosítása</h1>
    <?php
    include_once('db_config.php');
    global $connection;

    $id = $_GET['id'];

    $sql = "SELECT id_merchandise, picture, merchandise_name, price, merchandise_description, number_of_merchandise FROM merchandise WHERE id_merchandise = '$id'";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result)) {
            ?>
            <form method="post" action="modositas2.php" class="form-inline">
                <div class="form-group">
                    <label for="merchandise_name">Termék neve:</label><br/>
                    <input type="text" class="form-control" id="merchandise_name" name="merchandise_name"
                           value="<?php echo $record['merchandise_name'] ?>"/>
                </div>
                <br/><br/>

                <div class="form-group">
                    <label for="picture">Kép:</label><br/>
                    <input type="text" class="form-control" id="picture" name="picture"
                           value="<?php echo $record['picture'] ?>"/>
                </div>
                <br/><br/>

                <div class="form-group">
                    <label for="price">Termék ára:</label><br/>
                    <input type="text" class="form-control" id="price" name="price"
                           value="<?php echo $record['price'] ?> din."/>
                </div>
                <br/><br/>

                <div class="form-group">
                    <label for="description">Termék leírása:</label><br/>
                        <textarea class="form-control" id="description" name="description" rows="5" cols="20"
                                  placeholder="<?php echo $record['merchandise_description'] ?>"></textarea>
                </div>
                <br/><br/>

                <div class="form-group">
                    <label for="products">Termékek száma:</label><br/>
                    <input type="text" class="form-control" id="products" name="products"
                           value="<?php echo $record['number_of_merchandise'] ?>"/>
                </div>
                <br/><br/>

                <div class="form-group">
                    <input type="hidden" class="form-control" id="id_merchandise" name="id_merchandise"
                           value="<?php echo $record['id_merchandise'] ?>"/>
                </div>
                <br/><br/>
                <button type="submit" class="btn btn-default">Módosítás</button>
            </form>
            <?php
        }
    }
    ?>
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