<?php
if (isset($_POST['status']) && isset($_POST['id_order'])) {
    include('db_config.php');
    global $connection;

    if ($_POST['status'] != '' && !empty($_POST['id_order'])) {
        $status = $_POST['status'];
        $status = mysqli_real_escape_string($connection, $status);

        $id = $_POST['id_order'];
        $id = mysqli_real_escape_string($connection, $id);

        $sql = "UPDATE orders SET status = '$status' WHERE id_order = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

        header('Location:rendelesek.php');
        exit();
    }
}
?>