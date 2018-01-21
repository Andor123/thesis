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
    <h1>Meccs módosítása</h1>
    <?php
        include_once('db_config.php');
        global $connection;

        $id = $_GET['id'];

        $sql = "SELECT id_match, match_name, name_of_venue, datetime, price, match_description, number_of_tickets FROM matches WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result)) {
                ?>
                <form method="post" action="modositas.php" class="form-inline">
                    <div class="form-group">
                        <label for="match_name">Meccs neve:</label><br/>
                        <input type="text" class="form-control" id="match_name" name="match_name"
                               value="<?php echo $record['match_name'] ?>"/>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <label for="name_of_venue">Helyszín:</label><br/>
                        <input type="text" class="form-control" id="name_of_venue" name="name_of_venue"
                               value="<?php echo $record['name_of_venue'] ?>"/>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <label for="datetime">Meccs dátuma:</label><br/>
                        <input type="text" class="form-control" id="datetime" name="datetime"
                               value="<?php echo $record['datetime'] ?>"/>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <label for="price">Meccs ára:</label><br/>
                        <input type="text" class="form-control" id="price" name="price"
                               value="<?php echo $record['price'] ?> din."/>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <label for="description">Meccs leírása:</label><br/>
                        <textarea class="form-control" id="description" name="description" rows="5" cols="20"
                                  placeholder="<?php echo $record['match_description'] ?>"></textarea>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <label for="tickets">Jegyek száma:</label><br/>
                        <input type="text" class="form-control" id="tickets" name="tickets"
                               value="<?php echo $record['number_of_tickets'] ?>"/>
                    </div>
                    <br/><br/>

                    <div class="form-group">
                        <input type="hidden" class="form-control" id="id_match" name="id_match"
                               value="<?php echo $record['id_match'] ?>"/>
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