<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ground Operations Portal | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Ground Operations & Airport Staff</div>
    </div>

    <div class="container">

        <h2>Welcome Ground Staff</h2>
        <p style="margin-bottom: 30px;">Access airport ground duty schedules and flight terminal information.</p>

        <div class="menu-container">

            <a class="card-link" href="staff_login.php">
                <div class="menu-card">
                    <i class="fa-solid fa-id-card-clip" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Staff Sign In</h3>
                    <p>Access assigned flight duty rosters</p>
                </div>
            </a>

            <a class="card-link" href="staff_register.php">
                <div class="menu-card">
                    <i class="fa-solid fa-user-gear" style="font-size: 38px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Staff Onboarding</h3>
                    <p>Register ground operations account</p>
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