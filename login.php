<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows == 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: welcome.php");
            exit;
        } else {
            echo "<script>alert('Invalid password.');</script>";
        }
    } else {
        echo "<script>alert('User not found.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-left">Login</div>
    <div class="auth-right">
        <div class="auth-container">
            <h2>Sign In</h2>
            <form method="POST">
                <input type="email" class="input-field" name="email" placeholder="Email" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="submit" class="submit-btn" value="Login">
                <a href="register.php">Don't have an account? Register</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
