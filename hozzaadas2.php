<?php
if (isset($_POST['merchandise_name']) && isset($_POST['picture']) && isset($_POST['price']) && isset($_POST['description']) && isset($_POST['products'])) {
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

    $sql = "INSERT INTO merchandise (merchandise_name, picture, price, merchandise_description, number_of_merchandise) VALUES ('$name', '$picture', '$price', '$description', '$products')";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    header("Location:admin_termekek.php");
    exit();
}
?>