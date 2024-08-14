<?php
require 'connect.php'; 
require 'db_class.php'; 
session_start();

$db = new Database();
$db->connect($db_host, $db_user, $db_pass, $db_name);

$users = $db->select('users');
$products = $db->select('products');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id']; 
    $date = date('Y-m-d H:i:s');
    $room = $_POST['room'];
    $ext = $_POST['ext'];
    $comment = $_POST['notes'];
    $total = $_POST['total'];
    $status = 1;

    try {
        $columns = "user_id, date, room, ext, comment, total, status";
        $values = "'$user_id', '$date', '$room','$ext', '$comment', '$total', $status";
        $db->insert('orders', $columns, $values);
    
        $order_id = $db->lastInsertId();

        foreach ($_POST['products'] as $product_id => $product_data) {
            $quantity = $product_data['quantity'];
            $price = $product_data['price'];
            $productColumns = "order_id, user_id, product_id, quantity, price";
            $productValues = "'$order_id', '$user_id', '$product_id', '$quantity', '$price'";
            $db->insert('orders_products', $productColumns, $productValues);
        }

        echo "Order successfully added!";
    } catch (Exception $e) {
        echo "Failed to add order: " . $e->getMessage();
    }
} else {
    echo "Invalid request method.";
}
?>
