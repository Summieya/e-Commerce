<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$address = $_POST['address'];
$card = $_POST['card_number'];

// (Optional) Validate or sanitize here

// Fetch cart items
$cart_query = mysqli_query($connection, "SELECT * FROM cart_items WHERE user_id = $user_id");

if (mysqli_num_rows($cart_query) > 0) {
    while ($item = mysqli_fetch_assoc($cart_query)) {
        $product_id = $item['product_id'];
        $qty = $item['quantity'];

        // Insert into orders table
        mysqli_query($connection, "INSERT INTO orders (user_id, product_id, quantity, fullname, email, address, card_number, order_date)
        VALUES ($user_id, $product_id, $qty, '$fullname', '$email', '$address', '$card', NOW())");
    }

    // Clear cart after fake payment
    mysqli_query($connection, "DELETE FROM cart_items WHERE user_id = $user_id");

    header("Location: success.php");
    exit;
} else {
    echo "Your cart is empty!";
}
