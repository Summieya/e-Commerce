<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_SESSION['user_id'];
    $cart_id = (int) $_GET['id']; // Secure: cast to integer

    // Only delete the item if it belongs to the current user
    $query = "DELETE FROM cart_items WHERE id = $cart_id AND user_id = $user_id";
    mysqli_query($connection, $query);
}

header("Location: cart.php");
exit;
