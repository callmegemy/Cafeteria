<?php

require "connect.php";
require "db_class.php";
require "./forget_password.php";

$db = new Database();
$db->connect($db_host, $db_user, $db_pass, $db_name);

$user_exists = $db->checkIfUserExists("users", $_POST['email']);
if ($user_exists !== null) {
    $randomNumber = rand(1000, 9999);
    sendEmail($_POST['email'], $randomNumber);
    $user_id = $user_exists['id'];
    $db->insert('forget_password', "`user_id` , `random_number`", "'$user_id' , '$randomNumber'");
    $cookie_name = "user_id";
    $cookie_value = $user_exists['id'];
    $expire_time = time() + 4 * 3600; // 1 hour from now

    setcookie($cookie_name, $cookie_value, $expire_time, "/");
    header('Location: ../changePassword.php');
} else {
    echo "There's no account save in our database with email address";
}
