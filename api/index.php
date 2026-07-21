<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airline Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="navbar">
        <a href="index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE MANAGEMENT SYSTEM</span>
        </a>
        <div class="navbar-tagline">Flight Operations & Passenger Portal</div>
    </div>

    <div class="container">

        <h2>Select Your Portal</h2>
        <p style="margin-bottom: 25px;">Welcome to the Airline Management System. Choose your role to continue.</p>

        <div class="grid">

            <a class="card-link" href="admin/admin_login.php">
                <div class="card">
                    <i class="fa-solid fa-user-shield card-icon"></i>
                    <h3>Administrator</h3>
                    <p>Manage fleet, flights, staff assignments & flight status</p>
                </div>
            </a>

            <a class="card-link" href="user/user_menu.php">
                <div class="card">
                    <i class="fa-solid fa-passport card-icon"></i>
                    <h3>Passenger</h3>
                    <p>Search flights, reserve seats & view digital boarding passes</p>
                </div>
            </a>

            <a class="card-link" href="pilot/pilot_menu.php">
                <div class="card">
                    <i class="fa-solid fa-user-tie card-icon"></i>
                    <h3>Captain / Pilot</h3>
                    <p>Access cockpit assignments & personalized flight rosters</p>
                </div>
            </a>

            <a class="card-link" href="hostess/hostess_menu.php">
                <div class="card">
                    <i class="fa-solid fa-vest-patches card-icon"></i>
                    <h3>Cabin Crew</h3>
                    <p>View flight schedule, cabin assignments & passenger logs</p>
                </div>
            </a>

            <a class="card-link" href="staff/staff_menu.php">
                <div class="card">
                    <i class="fa-solid fa-id-card-clip card-icon"></i>
                    <h3>Ground Staff</h3>
                    <p>Manage gate assignments, luggage handling & flight duties</p>
                </div>
            </a>

        </div>

    </div>

    <!-- ✨ FEATURES -->
    <div class="features">

        <h2>Explore Features</h2>

        <div class="feature-grid">

            <a href="user/user_menu.php" class="card-link">
                <div class="feature-card">
                    <img src="images/flight1.jpg" alt="Flight Booking">
                    <h3><i class="fa-solid fa-ticket" style="color: var(--primary-gold); margin-right: 8px;"></i>Flight Booking</h3>
                    <p>Instant booking with real-time seat availability & routes across the globe.</p>
                </div>
            </a>

            <a href="user/user_menu.php" class="card-link">
                <div class="feature-card">
                    <img src="images/flight2.jpg" alt="Manage Bookings">
                    <h3><i class="fa-solid fa-suitcase-rolling" style="color: var(--primary-gold); margin-right: 8px;"></i>Manage Bookings</h3>
                    <p>View details, retrieve digital boarding passes, or manage cancellations effortlessly.</p>
                </div>
            </a>

            <a href="admin/admin_login.php" class="card-link">
                <div class="feature-card">
                    <img src="images/flight3.jpg" alt="Admin Control">
                    <h3><i class="fa-solid fa-sliders" style="color: var(--primary-gold); margin-right: 8px;"></i>Fleet Control</h3>
                    <p>Comprehensive admin hub to dispatch flights, assign crew, and monitor delays.</p>
                </div>
            </a>

        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>

</html>