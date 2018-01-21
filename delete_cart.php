<?php

session_start();

if (isset($_GET['id_match'])) {
    include('db_config.php');
    global $connection;

    $id_match = $_GET['id_match'];

    unset($_SESSION['cart'][$id_match]);

    header('Location:add_to_cart.php');
}

if (isset($_GET['id_merchandise'])) {
    include('db_config.php');
    global $connection;

    $id_merchandise = $_GET['id_merchandise'];

    unset($_SESSION['product'][$id_merchandise]);

    header('Location:add_to_cart.php');
}

?>