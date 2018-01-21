<?php
if (isset($_POST['match_name']) && isset($_POST['name_of_venue']) && isset($_POST['datetime']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['tickets']) && isset($_POST['id_match'])) {
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

    $id = $_POST['id_match'];
    $id = mysqli_real_escape_string($connection, $id);

    if (isset($_POST['match_name']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET match_name = '$name' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['name_of_venue']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET name_of_venue = '$venue' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['datetime']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET datetime = '$date' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['price']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET price = '$price' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['description']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET match_description = '$description' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['tickets']) && isset($_POST['id_match'])) {
        $sql = "UPDATE matches SET number_of_tickets = '$tickets' WHERE id_match = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    header("Location:admin_meccsek2.php?id=". $id);
    exit();
}
?>