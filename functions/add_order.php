<?php
// Include the necessary files
require 'connect.php'; // Adjust the path as needed
require 'db_class.php'; // Adjust the path as needed
session_start();

// Create an instance of the Database class and connect
$db = new Database();
$db->connect($db_host, $db_user, $db_pass, $db_name);

// Get users and products from the database
$users = $db->select('users');
$products = $db->select('products');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $user_id = $_SESSION['id']; // Assuming user ID is stored in session
    $date = date('Y-m-d H:i:s'); // Current date and time
    $room = $_POST['room'];
    $ext = $_POST['ext'];
    $comment = $_POST['notes'];
    $total = $_POST['total'];
    $status = 1;

    try {
        // Insert into orders table
        $columns = "user_id, date, room, ext, comment, total, status";
        $values = "'$user_id', '$date', '$room','$ext', '$comment', '$total', $status";
        $db->insert('orders', $columns, $values);
    
        // Get the last inserted order ID
        $order_id = $db->lastInsertId();

        // Insert each product into the orders_products table
        foreach ($_POST['products'] as $product_id => $product_data) {
            $quantity = $product_data['quantity'];
            $price = $product_data['price'];
            $productColumns = "order_id, product_id, quantity, price";
            $productValues = "'$order_id', '$product_id', '$quantity', '$price'";
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
