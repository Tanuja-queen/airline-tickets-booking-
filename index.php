<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Booking System</title>
    <link rel="stylesheet" href="style.css"> <!-- Link to the external CSS file -->
    <style>
        /* Set the background image for the entire page */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('http://2.bp.blogspot.com/-BzAaQQ8W8_8/UA5wp1xq_iI/AAAAAAAAH18/InfaJMRC73E/s1600/Airplane_aeroplane_aircraft_jet_wallpapers+(37).jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
        }

        .container {
            background-color: rgba(0, 0, 0, 0.7); /* Semi-transparent black background for better readability */
            margin: 20px auto;
            padding: 20px;
            border-radius: 10px;
            max-width: 800px;
            text-align: center;
        }

        header h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .nav a {
            color: #4CAF50;
            text-decoration: none;
            margin: 0 10px;
            font-size: 1.2em;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        .success-message {
            margin: 10px 0;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }

        .action-buttons {
            margin: 30px 0;
        }

        .action-buttons a {
            display: inline-block;
            margin: 10px 5px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
        }

        .action-buttons a:hover {
            background-color: #45a049;
        }

        footer {
            margin-top: 20px;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Welcome to the Airline Booking System</h1>
        </header>

        <div class="nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <p>Welcome, <?php echo htmlspecialchars($_SESSION['first_name']); ?>! <a href="logout.php">Logout</a></p>
            <?php elseif (isset($_SESSION['admin_id'])): ?>
                <p>Welcome, Admin! <a href="admin_logout.php">Logout</a></p>
            <?php else: ?>
                <a href="login.php">User Login</a> | 
                <a href="register.php">Register</a> |
                <a href="admin_login.php">Admin Login</a> <!-- Admin Login Button -->
            <?php endif; ?>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success-message">
                <p><?php echo $_SESSION['success']; ?></p>
            </div>
            <?php unset($_SESSION['success']); // Clear the success message ?>
        <?php endif; ?>

        <!-- Action Buttons Section -->
        <div class="action-buttons">
            <a href="flight.php">Available Flights</a>
            <a href="view_tickets.php">View Tickets</a> <!-- View Tickets Button -->
        </div>

        <footer>
            <p>&copy; 2024 Airline Booking System. All Rights Reserved.</p>
        </footer>
    </div>
</body>
</html>
