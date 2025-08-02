<?php
session_start();
include 'db.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home - My eCommerce</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="main-header">
    <div class="nav-left">
        <?php if (isset($_SESSION['user_id'])): ?>
            <span style="color: #ecf0f1;">Welcome, <?php echo $_SESSION['user_name']; ?></span> |
            <a href="logout.php">Logout</a>
            <a href="cart.php">Go to Cart</a>
        <?php else: ?>
            <a href="login.php">Login</a> |
            <a href="register.php">Register</a>
            
        <?php endif; ?>
    </div>
    <div class="site-name">My e-Commerce Store</div>
</header>

<section class="product-section">
 <div class="product-grid">
        <?php
        $products = [];
        $result = mysqli_query($connection, "SELECT * FROM products");

        while ($row = mysqli_fetch_assoc($result)){
            $products[] = $row;
        }
    ?>
        <?php foreach ($products as $index => $p): ?>
        <div class="product-card">
            <img src="<?php echo $p['image']; ?>" alt="product">
            <h3><?php echo $p['name']; ?></h3>
            <p>₹<?php echo $p['price']; ?></p>
            <?php if(isset($_SESSION['user_id'])): ?>
            <form action="add_to_cart.php" method="POST">
                 <input type="hidden" name="product_id" value="<?= $p['product_id'] ?>">
                <input type="hidden" name="name" value="<?= htmlspecialchars($p['name']) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($p['price']) ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($p['image']) ?>">
                <button type="submit"> Add to Cart</button>
            </form>
          <?php else: ?>
            <p style="color:red;">Please <a href="login.php">log in</a> to add products to cart.</p>
         <?php endif; ?>
        </div>
      <?php endforeach; ?>
 </div>
</section>

</body>
</html>
