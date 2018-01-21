<?php
session_start();

include('db_config.php');
global $connection;

$name = $_POST['name'];
$name = mysqli_real_escape_string($connection, $name);

$password = $_POST['password'];
$password = mysqli_real_escape_string($connection, $password);

$sql = "SELECT admin_name, admin_pass FROM admin WHERE admin_name = '$name'";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$_SESSION['admin'] = $row['admin_name'];

header('Location:rendelesek.php');
?>