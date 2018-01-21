<?php
session_start();

include('db_config.php');
global $connection;

$surname = $_POST['lastname'];
$surname = mysqli_real_escape_string($connection, $surname);

$firstname = $_POST['firstname'];
$firstname = mysqli_real_escape_string($connection, $firstname);

$email = $_POST['email'];
$email = mysqli_real_escape_string($connection, $email);

$password = $_POST['password'];
$password = mysqli_real_escape_string($connection, $password);

$pass_md5 = md5($password);

$activation_code = rand(1,1000000);

$activation_md5 = md5($activation_code);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Invalid email format';
}

if (strlen($password) < 6 || strlen($password) > 12) {
    echo 'The password needs to be longer than 6 or shorter than 12 characters';
}

function pass_generator($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength-1)];
    }
    return $randomString;
}

$pass_generator = pass_generator(8);

$date = date('Y-m-d H:i:s');

$sql = "INSERT INTO users (first_name, surname, email, password, datetime, activation_code, password_generator, active) VALUES ('$firstname','$surname','$email','$pass_md5','$date','$activation_md5','$pass_generator','0')";

$result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

$row = mysqli_fetch_array($result);

$to = $email;
$subject = 'Üdvözlünk a Kosárlabda.rs oldalunkon.';
$message = 'Nagy öröm az számunkra és megtiszteltetés is egyben, hogy erre az oldalra sikerült regisztrálnod. Viszont ahhoz, hogy aktiváljad a regisztrációdat, kattints erre a linkre: http://localhost/szakdoga/index.php?id=' . $activation_md5;
$header = 'From: webmaster@kosarlabda.rs' . "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $header);

$_SESSION['user'] = $firstname;

header('Location:index.php');
?>