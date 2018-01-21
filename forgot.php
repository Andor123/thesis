<?php
session_start();

include_once ('db_config.php');
global $connection;

$email = $_POST['email'];
$email = mysqli_real_escape_string($connection, $email);

$sql = "SELECT id_user, activation_code FROM users WHERE email = '$email'";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$to = $email;
$subject = 'Elfelejtett jelszó.';
$message = 'Szeretnéd megváltoztatni a jelszavadat? Akkor kattints erre a linkre: http://localhost/szakdoga/forgotten_password.php?forgotten_code=' . $row['activation_code'] . '&id=' . $row['id_user'];
$header = 'From: webmaster@kosarlabda.rs' . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $header);

header('Location:regisztralas.php');
?>