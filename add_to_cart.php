<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];


//checks if the product is already in the cart
$check = mysqli_query($connection, "SELECT * FROM cart_items WHERE user_id = $user_id AND product_id = $product_id");

if (mysqli_num_rows($check) > 0) {
    // update quantity in the cart.
    mysqli_query($connection, "UPDATE cart_items SET quantity = quantity + 1 WHERE user_id = $user_id AND product_id = $product_id");
} else {
    // insert nnew item
    mysqli_query($connection, "INSERT INTO cart_items (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");
}

header("Location: cart.php");
exit;
