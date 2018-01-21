<?php
    session_start();

$to = 'User';
$subject = 'Információ a vásárolt adatokról';
$message = "A következő termékeket rendelte meg tőlünk:\r\n\r\n";

if(isset($_SESSION['cart']) && is_array($_SESSION['cart']) && isset($_SESSION['id_ticket']) && isset($_SESSION['id_order'])) {
    include_once('db_config.php');
    global $connection;

    $ticket_id = $_SESSION['id_ticket'];
    $order_id = $_SESSION['id_order'];

    foreach ($_SESSION['cart'] as $k => $v) {
        $sql1 = "SELECT match_name, price  FROM matches WHERE id_match = '$k'";
        $result1 = mysqli_query($connection, $sql1) or die(mysqli_error($connection));

        if (mysqli_num_rows($result1) > 0) {
            while ($record1 = mysqli_fetch_array($result1)) {
                $message .= $record1['match_name'] . "\r\n" . $v * $record1['price'] . "din.\r\n\r\n";
            }
        }

        $order_sql1 = "INSERT INTO orders_cart (id_ticket, amount, id_order) VALUES ('$ticket_id', '$v', '$order_id')";
        $order_result1 = mysqli_query($connection, $order_sql1) or die(mysqli_error($connection));
    }
}

if (isset($_SESSION['product']) && is_array($_SESSION['product']) && isset($_SESSION['id_product']) && isset($_SESSION['id_order'])) {
    include_once('db_config.php');
    global $connection;

    $product_id = $_SESSION['id_product'];
    $order_id = $_SESSION['id_order'];

    foreach ($_SESSION['product'] as $k => $v) {
        $sql2 = "SELECT merchandise_name, price  FROM merchandise WHERE id_merchandise = '$k'";
        $result2 = mysqli_query($connection, $sql2) or die(mysqli_error($connection));

        if (mysqli_num_rows($result2) > 0) {
            while ($record2 = mysqli_fetch_array($result2)) {
                $message .= $record2['merchandise_name'] . "\r\n" . $v * $record2['price'] . "din.\r\n\r\n";
            }
        }

        $order_sql2 = "INSERT INTO orders_products (id_product, amount, id_order) VALUES ('$product_id', '$v', '$order_id')";
        $order_result2 = mysqli_query($connection, $order_sql2) or die(mysqli_error($connection));
    }
}
$header = 'From: webmaster@kosarlabda.rs' . "\r\n" .
    'Reply-To: ' . $to . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $header);

header("Location:vasarlas.php");
?>