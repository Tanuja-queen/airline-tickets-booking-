<?php
include('db.php'); // Include the database connection file

// Test query
try {
    $stmt = $pdo->query("SELECT 1"); // Simple query to test connection
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Error executing query: " . $e->getMessage();
}
?>
