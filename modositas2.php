<?php
if (isset($_POST['merchandise_name']) && isset($_POST['picture']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['products']) && isset($_POST['id_merchandise'])) {
    include_once ('db_config.php');
    global $connection;

    $name = $_POST['merchandise_name'];
    $name = mysqli_real_escape_string($connection, $name);

    if (file_exists('images/' . $_POST['picture'])) {
        $picture = $_POST['picture'];
        $picture = mysqli_real_escape_string($connection, $picture);
    }
    else {
        $picture = 'logo.png';
        $picture = mysqli_real_escape_string($connection, $picture);
    }

    $price = $_POST['price'];
    $price = mysqli_real_escape_string($connection, $price);

    $description = $_POST['description'];
    $description = mysqli_real_escape_string($connection, $description);

    $products = $_POST['products'];
    $products = mysqli_real_escape_string($connection, $products);

    $id = $_POST['id_merchandise'];
    $id = mysqli_real_escape_string($connection, $id);

    if (isset($_POST['merchandise_name']) && isset($_POST['id_merchandise'])) {
        $sql = "UPDATE merchandise SET merchandise_name = '$name' WHERE id_merchandise = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['picture']) && isset($_POST['id_merchandise'])) {
        $sql = "UPDATE merchandise SET picture = '$picture' WHERE id_merchandise = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['price']) && isset($_POST['id_merchandise'])) {
        $sql = "UPDATE merchandise SET price = '$price' WHERE id_merchandise = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['description']) && isset($_POST['id_merchandise'])) {
        $sql = "UPDATE merchandise SET merchandise_description = '$description' WHERE id_merchandise = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    if (isset($_POST['products']) && isset($_POST['id_merchandise'])) {
        $sql = "UPDATE merchandise SET number_of_merchandise = '$products' WHERE id_merchandise = '$id'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
    }

    header("Location:admin_termekek2.php?id=". $id);
    exit();
}
?>