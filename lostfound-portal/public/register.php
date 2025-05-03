<?php
session_start();
require_once __DIR__ . '/../classes/User.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    $result = $user->register($name, $email, $password);

    if ($result) {
        $message = "Registration successful! You can now <a href='login.php'>login</a>.";
    } else {
        $message = "Registration failed. Email might already be used.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/login_reg_style.css"> <!-- reuse same CSS -->
</head>
<body>
    <div class="container">
        <form method="post" action="">
            <h2>Register</h2>

            <?php if ($message): ?>
                <p class="error-message" style="color: <?= strpos($message, 'successful') !== false ? 'limegreen' : '#ff3f3f' ?>;">
                    <?= $message ?>
                </p>
            <?php endif; ?>

            <label>Name:</label>
            <input type="text" name="name" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Password:</label>
            <input type="password" name="password" required>

            <input type="submit" value="Register">

            <div class="register-link">
                <p>Already have an account? <a href="login.php">Login here</a></p>
            </div>
        </form>
    </div>
</body>
</html>
