<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$query = "SELECT ci.id as cart_id, p.product_id as product_id, p.name, p.price, p.image, ci.quantity 
          FROM cart_items ci
          JOIN products p ON ci.product_id = p.product_id
          WHERE ci.user_id = $user_id";

    $result = mysqli_query($connection, $query);
?>



<!DOCTYPE html>
<html>
<head>
  <title>Your Cart</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="main-header">
  <div class="navbar">
    <div class="nav-left"></div>
    <div class="nav-right">
      <?php if (isset($_SESSION['user_id'])): ?>
        Welcome, <?php echo $_SESSION['user_name']; ?> |
         <a href="index.php">Home |</a> 
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="login.php">Login</a> | <a href="register.php">Register</a>
      <?php endif; ?>
    </div>
    <div class="site-name">MyCart</div>
  </div>
</header>

<div class="product-section">
  

  <?php
  $total = 0;
  if (mysqli_num_rows($result) > 0):
  ?>
  <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; text-align: center; font-family: Tahoma,Sans-serif background: #fff;">
    <tr>
      <th>Image</th>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Subtotal</th>
      <th>Action</th>
    </tr>

    <?php while ($item = mysqli_fetch_assoc($result)):
  $subtotal = $item['price'] * $item['quantity'];
  $total += $subtotal;
    ?>
      <tr>
        <td><img src="<?php echo $item['image']; ?>" width="60"></td>
        <td><?php echo $item['name']; ?></td>
        <td>₹<?php echo $item['price']; ?></td>
        <td>
          <form action="update_cart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
            <input type="number" name="qty" value="<?php echo $item['quantity']; ?>" min="1" style="width: 60px;">
            <button type="submit">Update</button>
          </form>
        </td>
        <td>₹<?php echo $subtotal; ?></td>
        <td>
          <a href="remove_from_cart.php?id=<?php echo $item['cart_id']; ?>" class="remove-btn">Remove</a>
        </td>
      </tr>
      <?php endwhile; ?>

  </table>

  <h3 style="text-align:right; margin-top: 20px;">Total: ₹<?php echo $total; ?></h3>

  <div style="text-align:right;">
    <a href="checkout.php" class="chckout-btn">Proceed to Checkout</a>
  </div>

  <?php else: ?>
   <p style="text-align: center;">Your cart is empty.</p>
  <?php endif; ?>
</div>
