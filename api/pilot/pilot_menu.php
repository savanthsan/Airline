<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilot Portal | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Flight Operations & Cockpit Crew</div>
    </div>

    <div class="container">

        <h2>Welcome Captain</h2>
        <p style="margin-bottom: 30px;">Access your flight assignments, duty schedule & roster details.</p>

        <div class="menu-container">

            <a class="card-link" href="pilot_login.php">
                <div class="menu-card">
                    <i class="fa-solid fa-user-tie" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Pilot Sign In</h3>
                    <p>Access assigned flight schedules and roster</p>
                </div>
            </a>

            <a class="card-link" href="pilot_register.php">
                <div class="menu-card">
                    <i class="fa-solid fa-id-card" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Pilot Onboarding</h3>
                    <p>Register new pilot profile credentials</p>
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