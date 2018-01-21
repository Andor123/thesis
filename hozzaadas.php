<?php
if (isset($_POST['match_name']) && isset($_POST['name_of_venue']) && isset($_POST['datetime']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['tickets'])) {
    include_once ('db_config.php');
    global $connection;

    $name = $_POST['match_name'];
    $name = mysqli_real_escape_string($connection, $name);

    $venue = $_POST['name_of_venue'];
    $venue = mysqli_real_escape_string($connection, $venue);

    $date = $_POST['datetime'];
    $date = mysqli_real_escape_string($connection, $date);

    $price = $_POST['price'];
    $price = mysqli_real_escape_string($connection, $price);

    $description = $_POST['description'];
    $description = mysqli_real_escape_string($connection, $description);

    $tickets = $_POST['tickets'];
    $tickets = mysqli_real_escape_string($connection, $tickets);

    $sql = "INSERT INTO matches (match_name, name_of_venue, datetime, price, match_description, number_of_tickets) VALUES ('$name', '$venue', '$date', '$price', '$description', '$tickets')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    header("Location:admin_meccsek.php");
    exit();
}
?>