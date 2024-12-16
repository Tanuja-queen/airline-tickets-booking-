<?php
include('db.php'); // Include the database connection

// Fetch flights data from the database
try {
    $stmt = $pdo->query("SELECT * FROM flights");
    $flights = $stmt->fetchAll(); // Fetch all flights as an associative array
} catch (PDOException $e) {
    die("Error fetching flights: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights Management</title>
    <link rel="stylesheet" href="admin_flights.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Manage Flights</h1>
            <a href="add_flight.php" class="add-flight-btn">Add Flight</a> <!-- Add Flight Button -->
        </header>

        <section class="flights-section">
            <table class="flights-table">
                <thead>
                    <tr>
                        <th>Flight No</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($flights)): ?>
                        <?php foreach ($flights as $flight): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($flight['flight_no']); ?></td>
                                <td><?php echo htmlspecialchars($flight['from']); ?></td>
                                <td><?php echo htmlspecialchars($flight['to']); ?></td>
                                <td><?php echo htmlspecialchars($flight['price']); ?></td>
                                <td>
                                    <a href="edit_flight.php?id=<?php echo $flight['id']; ?>" class="edit-btn">Edit</a>
                                    <a href="delete_flight.php?id=<?php echo $flight['id']; ?>" class="delete-btn">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No flights available. Click "Add Flight" to create a new one.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
