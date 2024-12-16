<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

require 'helpers/init_conn_db.php'; // Adjust path if necessary

if (isset($_POST['ticket_id'])) {
    $ticket_id = $_POST['ticket_id'];

    // Fetch ticket details based on ticket_id
    $sql = "SELECT t.*, f.flight_name, f.date_of_travel FROM tickets t INNER JOIN flights f ON t.flight_id = f.flight_id WHERE t.ticket_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $ticket_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $ticket = mysqli_fetch_assoc($result);

    if ($ticket) {
        echo "<h1>Ticket Details</h1>";
        echo "<p><strong>Flight Name:</strong> " . htmlspecialchars($ticket['flight_name']) . "</p>";
        echo "<p><strong>Seat Number:</strong> " . htmlspecialchars($ticket['seat_number']) . "</p>";
        echo "<p><strong>Date of Travel:</strong> " . htmlspecialchars($ticket['date_of_travel']) . "</p>";
        echo "<button onclick='window.print()'>Print Ticket</button>";
    } else {
        echo "<p>No ticket found.</p>";
    }

    // Close statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "<p>Ticket ID is missing.</p>";
}
?>
