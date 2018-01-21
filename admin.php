<?php
session_start();

include('db_config.php');
global $connection;

$name = $_POST['name'];
$name = mysqli_real_escape_string($connection, $name);

$password = $_POST['password'];
$password = mysqli_real_escape_string($connection, $password);

$pass_md5 = md5($password);

if (strlen($password) < 6 || strlen($password) > 12) {
    echo 'The password needs to be longer than 6 or shorter than 12 characters';
}

$sql = "INSERT INTO admin(admin_name, admin_pass) VALUES ('$name', '$pass_md5')";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$_SESSION['admin'] = $name;

header('Location:rendelesek.php');
?>