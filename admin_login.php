<?php
session_start();
include('db.php'); // Database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if username and password are correct
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE Username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    // If the admin is found and password matches
    if ($admin && $admin['Password'] === $password) {
        // Store the admin's ID and username in the session
        $_SESSION['admin_id'] = $admin['Id'];
        $_SESSION['admin_username'] = $admin['Username'];

        // Redirect to admin dashboard
        header('Location: admin_dashboard.php');
        exit();
    } else {
        $error_message = 'Invalid username or password.';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="admin_login.css"> <!-- Link to CSS -->
</head>
<body>
    <div class="login-container">
        <h1>Admin Login</h1>
        <?php if (isset($error_message)): ?>
            <p style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="admin_login.php" method="post">
            <input type="text" name="username" placeholder="Username" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
