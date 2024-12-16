<?php
session_start();

// Include database connection
require 'db.php';

// Check if a flight ID is provided
if (!isset($_GET['id'])) {
    die("No flight selected.");
}

$flight_id = $_GET['id'];

// Verify user session details
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_email'])) {
    // Redirect to payment with a guest placeholder
    $_SESSION['user_id'] = 0; // Guest user ID
    $_SESSION['user_name'] = "Guest";
    $_SESSION['user_email'] = "guest@example.com";
}

// Redirect to payment page
header("Location: payment.php?flight_id=$flight_id");
exit();
