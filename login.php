<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $host = 'localhost';
    $db = 'airline_booking_system'; // Replace with your database name
    $user = 'root'; // Replace with your database username
    $pass = ''; // Replace with your database password

    try {
        // Create PDO connection
        $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Get form data
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Fetch user data
        $query = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id']; // User ID
            $_SESSION['user_email'] = $user['email']; // User Email
            $_SESSION['first_name'] = $user['first_name']; // Optional, for personalization
            $_SESSION['success'] = "Login successful!";

            // Redirect to the index page
            header("Location: index.php");
            exit;
        } else {
            $_SESSION['error'] = "Invalid email or password!";
            header("Location: login.php");
            exit;
        }
    } catch (PDOException $e) {
        // Handle errors
        $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        header("Location: login.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="std_log.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p class='error'>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }
        ?>
        <form method="POST" action="login.php">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
