<?php
// Database connection details
$host = 'localhost'; // Your database host
$dbname = 'airline_booking_system'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

try {
    // Create PDO instance for database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exception mode for error handling
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Set default fetch mode to associative array
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); // Display error message if connection fails
}
?>
