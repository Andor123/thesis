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
                    <li class="active"><a href="rendelesek.php">Rendelések listája</a></li>
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
    <h1>Rendelések Listája</h1>
</div>

<div class="table-responsive orderrows wow slideInUp">
    <table class="table">
        <thead>
        <tr>
            <th>Rendelés azonosítója</th>
            <th>Admin neve</th>
            <th>Státusz</th>
            <th>Státusz megváltoztatása</th>
        </tr>
        </thead>
        <?php
        include('db_config.php');
        global $connection;

        $admin = $_SESSION['admin'];

        $sql = "SELECT orders.id_order, orders.id_admin, admin.admin_name, orders.status FROM orders JOIN admin ON orders.id_admin = admin.id_admin WHERE admin.admin_name = '$admin'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

        if (mysqli_num_rows($result) > 0) {
            while ($record = mysqli_fetch_array($result)) {
                ?>
                <tbody>
                <tr>
                    <td><?php echo $record['id_order'] ?></td>
                    <td><?php echo $record['admin_name'] ?></td>
                    <td><?php echo $record['status'] ?></td>
                    <td>
                        <form method="post" action="rendelesek2.php" class="form-inline">
                            <div class="form-group">
                                <select name="status" id="status">
                                    <option value=""></option>
                                    <option value="ordered">Megrendelve</option>
                                    <option value="in progress">Folyamatban</option>
                                    <option value="delivered">Elküldve</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_order" value="<?php echo $record['id_order'] ?>" />
                            </div>
                            <button type="submit" class="btn btn-default">Elfogadás</button>
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
            <td colspan="5">Összesen: <?php echo mysqli_num_rows($result); ?></td>
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