<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $product_id = (int)$_POST['product_id'];
    $qty = max(1, (int)$_POST['qty']); 

    $query = "UPDATE cart_items SET quantity = $qty WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($connection, $query);
}

header("Location: cart.php");
exit;
