<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabin Crew Portal | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Cabin Crew Services</div>
    </div>

    <div class="container">

        <h2>Welcome Cabin Crew</h2>
        <p style="margin-bottom: 30px;">Access your flight schedule, duty roster, and flight information.</p>

        <div class="menu-container">

            <a class="card-link" href="hostess_login.php">
                <div class="menu-card">
                    <i class="fa-solid fa-vest-patches" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Crew Sign In</h3>
                    <p>Access assigned flight rosters and schedules</p>
                </div>
            </a>

            <a class="card-link" href="hostess_register.php">
                <div class="menu-card">
                    <i class="fa-solid fa-user-plus" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Crew Onboarding</h3>
                    <p>Register new cabin crew profile</p>
                </div>
            </a>

        </div>

        <a class="back-btn" href="../index.php"><i class="fa-solid fa-arrow-left"></i> Back to Main Portal</a>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>