<?php
include('db.php'); // Include database connection

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the flight from the database
    $stmt = $pdo->prepare("DELETE FROM flights WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: flights.php?success=Flight deleted successfully");
    exit();
}
?>
