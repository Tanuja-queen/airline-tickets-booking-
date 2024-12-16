<?php
session_start();
include('db.php'); // Include database connection

// Check if the flight ID is provided in the URL
if (!isset($_GET['id'])) {
    die('Flight ID is required.');
}

$flight_id = $_GET['id'];

// Fetch current flight data for editing
$stmt = $pdo->prepare("SELECT * FROM flights WHERE id = ?");
$stmt->execute([$flight_id]);
$flight = $stmt->fetch();

// If the flight is not found
if (!$flight) {
    die('Flight not found.');
}

// Handle form submission for updating the flight
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_no = $_POST['flight_no'];
    $from = $_POST['from'];
    $to = $_POST['to'];
    $price = $_POST['price'];

    // Update the flight record
    $update_stmt = $pdo->prepare("UPDATE flights SET flight_no = ?, `from` = ?, `to` = ?, price = ? WHERE id = ?");
    $update_stmt->execute([$flight_no, $from, $to, $price, $flight_id]);

    // Redirect to the flights page after update
    $_SESSION['success'] = 'Flight updated successfully!';
    header('Location: flights.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Flight</title>
    <link rel="stylesheet" href="admin_flights.css"> <!-- Link to city management CSS -->
</head>
<body>
    <div class="container">
        <h2>Edit Flight</h2>
        <!-- Display success message if any -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <p><?php echo $_SESSION['success']; ?></p>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Edit Flight Form -->
        <form action="edit_flight.php?id=<?php echo $flight_id; ?>" method="POST">
            <div class="form-group">
                <label for="flight_no">Flight Number</label>
                <input type="text" name="flight_no" value="<?php echo htmlspecialchars($flight['flight_no']); ?>" required>
            </div>

            <div class="form-group">
                <label for="from">From</label>
                <input type="text" name="from" value="<?php echo htmlspecialchars($flight['from']); ?>" required>
            </div>

            <div class="form-group">
                <label for="to">To</label>
                <input type="text" name="to" value="<?php echo htmlspecialchars($flight['to']); ?>" required>
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" name="price" value="<?php echo htmlspecialchars($flight['price']); ?>" step="0.01" required>
            </div>

            <button type="submit">Update Flight</button>
        </form>
    </div>
</body>
</html>
