<?php
session_start();

if (isset($_SESSION['user']) && isset($_SESSION['admin'])) {
    include('db_config.php');
    global $connection;

    $user = $_SESSION['user'];
    $admin = $_SESSION['admin'];

    $merchandise = $_POST['comment_brand'];
    $merchandise = mysqli_real_escape_string($connection, $merchandise);

    $comment = $_POST['comment'];
    $comment = mysqli_real_escape_string($connection, $comment);

    $user_sql = "SELECT id_user FROM users WHERE first_name = '$user'";

    $user_result = mysqli_query($connection, $user_sql) or die(mysqli_error($connection));

    $user_row = mysqli_fetch_array($user_result);

    $admin_sql = "SELECT id_admin FROM admin WHERE admin_name = '$admin'";

    $admin_result = mysqli_query($connection, $admin_sql) or die(mysqli_error($connection));

    $admin_row = mysqli_fetch_array($admin_result);

    $merchandise_sql = "SELECT id_merchandise FROM merchandise WHERE merchandise_name = '$merchandise'";

    $merchandise_result = mysqli_query($connection, $merchandise_sql) or die(mysqli_error($connection));

    $merchandise_row = mysqli_fetch_array($merchandise_result);

    $user_id = $user_row['id_user'];
    $admin_id = $admin_row['id_admin'];
    $merchandise_id = $merchandise_row['id_merchandise'];

    $sql = "INSERT INTO comments (id_user, id_admin, id_merchandise, comment, active, datetime) VALUES ('$user_id','$admin_id','$merchandise_id','$comment','1',now())";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    header('Location:cuccok.php');
}
?>