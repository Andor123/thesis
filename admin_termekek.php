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
                    <li class="active"><a href="admin_termekek.php">Termékek listája</a></li>
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
    <h1>Termékek listája</h1>
</div>

<div class="table-responsive orderrows wow slideInUp">
    <table class="table">
        <thead>
        <tr>
            <th>Termék neve</th>
            <th>Kép</th>
            <th>Termék ár</th>
            <th>Leírás</th>
            <th>Módosítás</th>
        </tr>
        </thead>
        <?php
        include('db_config.php');
        global $connection;

        $admin = $_SESSION['admin'];

        $sql = "SELECT id_merchandise, picture, merchandise_name, price, merchandise_description, number_of_merchandise FROM merchandise";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result)) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $record['merchandise_name']; ?></td>
                    <td><img src="images/<?php echo $record['picture'] ?>" alt="image" /></td>
                    <td><?php echo $record['price'] ?> din.</td>
                    <td><?php echo $record['merchandise_description'] ?></td>
                    <td>
                        <a class="btn btn-default" href="admin_termekek2.php?id=<?php echo $record['id_merchandise'] ?>">Módosítás</a>
                    </td>
                </tr>
                </tbody>
                <?php
            }
        }
        ?>
        <tfoot>
        <tr>
            <td colspan="5">Összesen: <?php echo mysqli_num_rows($result); ?></td>
        </tr>
        </tfoot>
    </table>
    <a class="btn btn-default" href="admin_termekek3.php">Új termék hozzáadása</a>
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