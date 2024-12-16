<?php
session_start();

// Redirect to login if admin is not logged in
if (!isset($_SESSION['admin_id'])) {
    header('Location: admin_login.php');
    exit();
}

// Include database connection
include('db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <h2>Online Flight Booking</h2>
            </div>
            <ul class="menu">
                <li><a href="admin_dashboard.php?page=home"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="booked_flights.php"><i class="fas fa-ticket-alt"></i> Booked</a></li>
                <li><a href="flights.php"><i class="fas fa-plane"></i> Flights</a></li>
                <li><a href="airports.php"><i class="fas fa-building"></i> Airport</a></li>
            </ul>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <header class="topbar">
                <h1>Administrator</h1>
                <a href="admin_logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </header>

            <!-- Dashboard Content -->
            <div class="content">
                <?php
                // Show content based on the current page
                $page = isset($_GET['page']) ? $_GET['page'] : 'home';

                if ($page === 'home') {
                    echo '
                    <div class="welcome">
                        <h2>Welcome back, Administrator!</h2>
                    </div>';
                } else {
                    echo '<p>Page not found!</p>';
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
