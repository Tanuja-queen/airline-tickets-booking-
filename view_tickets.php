<?php
// Start the session
session_start();

// Database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "airline_booking_system";

$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "You need to log in to view your tickets.";
    exit;
}

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Fetch the tickets assigned to the user
$sql = "SELECT * FROM tickets WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Tickets</title>
    <link rel="stylesheet" href="view_tickets.css">
</head>
<body>
    <div class="container">
        <h1>My Tickets</h1>

        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Flight No</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Price</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['flight_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['from']); ?></td>
                            <td><?php echo htmlspecialchars($row['to']); ?></td>
                            <td>$<?php echo number_format($row['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tickets found.</p>
        <?php endif; ?>

        <?php
        // Close the database connection
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
