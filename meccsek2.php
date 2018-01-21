<?php
include('db_config.php');
global $connection;

$id_match = isset($_GET['id_match']) ? (int)$_GET['id_match'] : 0;

if($id_match > 0) {
    $sql = "SELECT * FROM matches WHERE id_match = " . $id_match;
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}

if (isset($_GET['id_match'])) {
    echo '<a href="http://www.vipbox.bz/basketball/">Kattints a mérkőzésre</a>';
}

?>