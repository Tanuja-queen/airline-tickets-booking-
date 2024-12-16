<?php
// handle_flight.php

include('db.php'); // Include your database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and fetch form data
    $airline_name = $_POST['airline_name'] ?? '';
    $departure_airport = $_POST['departure_airport'] ?? '';
    $arrival_airport = $_POST['arrival_airport'] ?? '';
    $seats = $_POST['seat'] ?? 0;
    $price = $_POST['pric'] ?? 0.00;

    // Validate required fields
    if (empty($airline_name) || empty($departure_airport) || empty($arrival_airport)) {
        echo "Error: All fields are required.";
        exit();
    }

    // Insert into the flights table
    try {
        $stmt = $pdo->prepare("
            INSERT INTO flights (airline_name, departure_airport, arrival_airport, seats, price)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->execute([$airline_name, $departure_airport, $arrival_airport, $seats, $price]);

        // Redirect back to flights page with success message
        header('Location: flights.php?success=Flight added successfully');
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        exit();
    }
}
?>
