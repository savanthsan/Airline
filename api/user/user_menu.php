<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Portal | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Passenger Portal</div>
    </div>

    <div class="container">

        <h2>Welcome, Valued Passenger</h2>
        <p style="margin-bottom: 30px;">Sign in to your account or create a new account to book flights.</p>

        <div class="menu-container">

            <a class="card-link" href="user_login.php">
                <div class="menu-card">
                    <i class="fa-solid fa-right-to-bracket" style="font-size: 36px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Passenger Login</h3>
                    <p>Access your existing bookings, search flights, and manage tickets</p>
                </div>
            </a>

            <a class="card-link" href="user_register.php">
                <div class="menu-card">
                    <i class="fa-solid fa-user-plus" style="font-size: 36px; color: var(--primary-gold); margin-bottom: 15px;"></i>
                    <h3>Create Account</h3>
                    <p>Register as a new passenger to start booking flights worldwide</p>
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