<?php
session_start();

include_once ('db_config.php');
global $connection;

$password = $_POST['password'];
$password = mysqli_real_escape_string($connection, $password);

$id = $_GET['id'];
$id = mysqli_real_escape_string($connection, $id);

$password_md5 = md5($password);

$sql = "UPDATE users SET password = '$password_md5' WHERE id_user = '$id'";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

header('Location:regisztralas.php');
?>