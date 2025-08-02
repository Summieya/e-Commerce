<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Checkout</h2>

<form name="checkoutForm" class="checkout-Form" action="process_payment.php" method="POST">
  <label>Full Name:</label><br>
  <input type="text" name="fullname" class="input-field" required><br><br>

  <label>Email:</label><br>
  <input type="email" name="email" class="input-field" required><br><br>

  <label>Address:</label><br>
  <textarea name="address"class="input-field" required></textarea><br><br>

  <label>Card Number:</label><br>
  <input type="text" class="input-field"name="card_number" maxlength="16" required><br><br>

  <button class="sumbit-btn" type="submit">Pay Now</button>
</form>

</body>
</html>
