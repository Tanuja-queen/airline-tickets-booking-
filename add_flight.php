<?php
// Include database connection
require 'db.php';

// Initialize variables for form inputs and error messages
$flight_no = $from = $to = $price = "";
$error = $success = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_no = $_POST['flight_no'] ?? '';
    $from = $_POST['from'] ?? '';
    $to = $_POST['to'] ?? '';
    $price = $_POST['price'] ?? '';

    // Validation
    if (empty($flight_no) || empty($from) || empty($to) || empty($price)) {
        $error = "All fields are required.";
    } elseif (!is_numeric($price) || $price <= 0) {
        $error = "Please enter a valid price.";
    } else {
        try {
            // Insert flight details into the database
            $stmt = $pdo->prepare("INSERT INTO flights (flight_no, `from`, `to`, price) VALUES (?, ?, ?, ?)");
            $stmt->execute([$flight_no, $from, $to, $price]);
            $success = "Flight added successfully!";
            $flight_no = $from = $to = $price = ""; // Clear form fields
        } catch (PDOException $e) {
            $error = "Error adding flight: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_flight.css">
    <title>Add Flight</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Add Flight</h1>
    </header>
    <form action="add_flight.php" method="POST" class="add-flight-form">
        <?php if ($error): ?>
            <div class="error-msg"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="success-msg"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <div class="form-group">
            <label for="flight_no">Flight Number</label>
            <input type="text" name="flight_no" id="flight_no" value="<?= htmlspecialchars($flight_no) ?>" required>
        </div>
        <div class="form-group">
            <label for="from">From</label>
            <input type="text" name="from" id="from" value="<?= htmlspecialchars($from) ?>" required>
        </div>
        <div class="form-group">
            <label for="to">To</label>
            <input type="text" name="to" id="to" value="<?= htmlspecialchars($to) ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" step="0.01" value="<?= htmlspecialchars($price) ?>" required>
        </div>
        <button type="submit" class="btn-submit">Add Flight</button>
        <a href="flights.php" class="btn-back">Back to Flights</a>
    </form>
</div>
</body>
</html>
