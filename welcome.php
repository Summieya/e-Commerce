<?php
session_start();

//if login fails
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header class="main-header">
    <div class="navbar">
        <div class="nav-left">
            <?php if (isset($_SESSION['user_id'])): ?>
                Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> |
                <a href="logout.php">Logout</a>
            <?php endif; ?>
        </div>
        <div class="site-name">My eCommerce Store</div>
    </div>
</header>

<div style="text-align:center; margin-top: 80px;">
    <h2>Hello <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
    <p>You have successfully logged in.</p>
    <p><a href="index.php">Go to Home</a></p>
</div>

</body>
</html>
