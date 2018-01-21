<?php
session_start();

include('db_config.php');
global $connection;

$email = $_POST['email'];
$email = mysqli_real_escape_string($connection, $email);

$password = $_POST['password'];
$password = mysqli_real_escape_string($connection, $password);

$sql = "SELECT first_name, email, password FROM users WHERE email = '$email'";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$_SESSION['user'] = $row['first_name'];

header('Location:index.php?signedin=yes');
?>