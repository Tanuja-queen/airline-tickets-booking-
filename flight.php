<?php
// Include the database connection file
require 'db.php';

try {
    // Fetch all flights from the database
    $stmt = $pdo->query("SELECT id, flight_no, `from`, `to`, price FROM flights");
    $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching flights: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="flight.css">
    <title>Available Flights</title>
</head>
<body>
<div class="container">
    <header>
        <h1>Available Flights</h1>
    </header>
    <?php if (empty($flights)): ?>
        <p>No flights available at the moment.</p>
    <?php else: ?>
        <table class="flights-table">
            <thead>
                <tr>
                    <th>Flight No</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($flights as $flight): ?>
                    <tr>
                        <td><?= htmlspecialchars($flight['flight_no']) ?></td>
                        <td><?= htmlspecialchars($flight['from']) ?></td>
                        <td><?= htmlspecialchars($flight['to']) ?></td>
                        <td>$<?= number_format($flight['price'], 2) ?></td>
                        <td>
                            <a href="book_flight.php?id=<?= $flight['id'] ?>" class="btn-book">Book Now</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
