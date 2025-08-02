<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $connection->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email already exists.');</script>";
    } else {
        $stmt = $connection->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);
        $stmt->execute();
        echo "<script>alert('Registration successful. Please login.'); window.location='login.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-left">Register</div>
    <div class="auth-right">
        <div class="auth-container">
            <h2>Sign Up</h2>
            <form method="POST">
                <input type="text" class="input-field" name="name" placeholder="Name" required>
                <input type="email" class="input-field" name="email" placeholder="Email" required>
                <input type="password" class="input-field" name="password" placeholder="Password" required>
                <input type="submit" class="submit-btn" value="Register">
                <a href="login.php">Already have an account? Login</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>
