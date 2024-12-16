<?php
require_once 'db.php'; // Include the database connection file

// Admin credentials
$username = 'admin'; // Your admin username
$password = 'admin_password'; // Raw password

// Hash the password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert the admin credentials into the database
try {
    $stmt = $pdo->prepare("INSERT INTO admins (username, password, first_name) VALUES (:username, :password, :first_name)");
    $stmt->execute([
        ':username' => $username,
        ':password' => $hashed_password,
        ':first_name' => 'Admin', // Optional first name
    ]);
    echo "Admin account created successfully.";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
