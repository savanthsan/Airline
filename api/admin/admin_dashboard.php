<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="profile">
            <span><i class="fa-solid fa-user-shield" style="color: var(--primary-gold); margin-right: 6px;"></i>Admin: <strong><?php echo htmlspecialchars($_SESSION['admin'] ?? 'Administrator'); ?></strong></span>
            <a href="admin_login.php" class="btn btn-gold" style="padding: 6px 14px; font-size: 12px; margin-left: 10px;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <div class="container">

        <h2>Fleet & Operations Control Center</h2>
        <p style="margin-bottom: 35px;">Complete administrative control over flights, crew dispatch, schedules, and staff rosters.</p>

        <!-- FLIGHT MANAGEMENT SECTION -->
        <h3 style="color: var(--text-white); font-size: 18px; text-align: left; margin: 30px 0 15px; font-family: var(--font-main); text-transform: uppercase; letter-spacing: 1.5px; border-left: 4px solid var(--primary-red); padding-left: 10px;">
            <i class="fa-solid fa-plane-up" style="color: var(--primary-gold); margin-right: 8px;"></i> Flight & Dispatch Operations
        </h3>

        <div class="grid" style="margin-top: 15px; justify-content: flex-start;">

            <a class="card-link" href="add_flight.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-circle-plus card-icon"></i>
                    <h3>Create Flight</h3>
                    <p>Add new flight schedule & seat capacity</p>
                </div>
            </a>

            <a class="card-link" href="view_flights.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-list-check card-icon"></i>
                    <h3>View Flights</h3>
                    <p>Monitor active routes, capacity & status</p>
                </div>
            </a>

            <a class="card-link" href="update_flight_status.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-rotate card-icon"></i>
                    <h3>Update Status</h3>
                    <p>Set delays, cancellations or arrival times</p>
                </div>
            </a>

        </div>

        <!-- CREW & STAFF MANAGEMENT SECTION -->
        <h3 style="color: var(--text-white); font-size: 18px; text-align: left; margin: 40px 0 15px; font-family: var(--font-main); text-transform: uppercase; letter-spacing: 1.5px; border-left: 4px solid var(--primary-gold); padding-left: 10px;">
            <i class="fa-solid fa-users-gear" style="color: var(--primary-gold); margin-right: 8px;"></i> Crew Roster & Staff Dispatch
        </h3>

        <div class="grid" style="margin-top: 15px; justify-content: flex-start;">

            <a class="card-link" href="assign_staff.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-clipboard-user card-icon"></i>
                    <h3>Assign Crew</h3>
                    <p>Dispatch Pilot, Hostess & Ground Staff to flight</p>
                </div>
            </a>

            <a class="card-link" href="add_pilot.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-user-tie card-icon"></i>
                    <h3>Add Pilot</h3>
                    <p>Register new Captain / Co-Pilot</p>
                </div>
            </a>

            <a class="card-link" href="view_pilots.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-users-viewfinder card-icon"></i>
                    <h3>View Pilots</h3>
                    <p>Browse registered pilot directory</p>
                </div>
            </a>

            <a class="card-link" href="add_hostess.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-vest-patches card-icon"></i>
                    <h3>Add Cabin Crew</h3>
                    <p>Register flight hostess / steward</p>
                </div>
            </a>

            <a class="card-link" href="view_hostess.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-users card-icon"></i>
                    <h3>View Cabin Crew</h3>
                    <p>Browse flight hostess roster</p>
                </div>
            </a>

            <a class="card-link" href="add_staff.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-id-card-clip card-icon"></i>
                    <h3>Add Ground Staff</h3>
                    <p>Onboard airport ground operations staff</p>
                </div>
            </a>

            <a class="card-link" href="view_staff.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-user-gear card-icon"></i>
                    <h3>View Ground Staff</h3>
                    <p>Browse ground staff directory</p>
                </div>
            </a>

            <a class="card-link" href="delete_staff.php">
                <div class="card" style="width: 250px;">
                    <i class="fa-solid fa-user-minus card-icon" style="color: var(--primary-red);"></i>
                    <h3>Remove Staff</h3>
                    <p>Deactivate personnel account</p>
                </div>
            </a>

        </div>

        <div style="margin-top: 50px;">
            <a class="back-btn" href="../index.php"><i class="fa-solid fa-house"></i> Main Portal</a>
        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>