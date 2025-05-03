<?php
session_start();
require_once __DIR__ . '/../classes/User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    $loginResult = $user->login($email, $password);

    if ($loginResult) {
        $_SESSION['user_id'] = $loginResult['user_id'];
        $_SESSION['name'] = $loginResult['name'];
        $_SESSION['role'] = $loginResult['role'];

        // Redirect to dashboard or admin panel
        if ($loginResult['role'] === 'admin') {
            header("Location: admin/dashboard.php");
        } else {
            header("Location: dashboard.php");
        }
        exit;
    } else {
        $message = "Invalid email or password!";
    }
}
?>

<!-- Simple HTML Form -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/login_reg_style.css">
</head>
<body>
<div class="container">
    <!-- Entire content is now inside the form -->
    <form method="post" action="">
        <div class="login-wrapper">
            <h2>Login</h2>

            <!-- Display error message if there is one -->
            <?php if ($message): ?>
                <p class="error-message"><?php echo $message; ?></p>
            <?php endif; ?>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Login">

            <!-- Register link inside the same box -->
            <div class="register-link">
                <p>Don't have an account? <a href="register.php">Register here</a></p>
            </div>
        </div>
    </form>
</div>

