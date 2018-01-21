<?php
if (isset($_POST['surname']) && isset($_POST['first_name'])&& isset($_POST['id_user'])) {
    include_once ('db_config.php');
    global $connection;

    $surname = $_POST['surname'];
    $first_name = $_POST['first_name'];
    $id = $_POST['id_user'];

    if (isset($_POST['surname']) && isset($_POST['id_user'])) {
        $sql = "UPDATE users SET surname = '$surname' WHERE id_user = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['first_name']) && isset($_POST['id_user'])) {
        $sql = "UPDATE users SET first_name = '$first_name' WHERE id_user = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    header("Location:admin_user2.php?id=". $id);
    exit();
}
?>