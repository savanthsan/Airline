<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Dashboard | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="profile">
            <span><i class="fa-solid fa-user-circle" style="color: var(--primary-gold); margin-right: 6px;"></i><?php echo htmlspecialchars($_SESSION['user'] ?? 'Passenger'); ?></span>
            <a href="user_login.php" class="btn btn-gold" style="padding: 6px 14px; font-size: 12px; margin-left: 10px;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <div class="container">

        <h2>Passenger Dashboard</h2>
        <p style="margin-bottom: 35px;">Manage your flight travel, search routes, and view digital tickets.</p>

        <div class="grid">

            <a class="card-link" href="search_flight.php">
                <div class="card">
                    <i class="fa-solid fa-magnifying-glass-location card-icon"></i>
                    <h3>Search Flights</h3>
                    <p>Find available global routes, flight schedules, and reserve seats</p>
                </div>
            </a>

            <a class="card-link" href="my_bookings.php">
                <div class="card">
                    <i class="fa-solid fa-ticket card-icon"></i>
                    <h3>My Bookings</h3>
                    <p>View your confirmed bookings, print boarding passes & manage cancellations</p>
                </div>
            </a>

        </div>

        <div style="margin-top: 50px;">
            <a class="back-btn" href="../index.php"><i class="fa-solid fa-house"></i> Home</a>
        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>