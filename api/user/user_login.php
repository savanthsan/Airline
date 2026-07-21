<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Login | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Passenger Sign In</div>
    </div>

    <div class="auth-container">

        <div class="auth-card">

            <i class="fa-solid fa-circle-user" style="font-size: 50px; color: var(--primary-gold); margin-bottom: 15px;"></i>
            <h2>Passenger Login</h2>
            <p style="margin-bottom: 25px; font-size: 13px;">Enter your credentials to access your flight dashboard</p>

            <form action="user_check.php" method="POST">

                <div class="form-group">
                    <label><i class="fa-solid fa-envelope" style="margin-right: 6px;"></i>Email Address</label>
                    <input type="email" name="email" placeholder="e.g. passenger@example.com" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-lock" style="margin-right: 6px;"></i>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" style="width: 100%; margin-top: 10px;">
                    <i class="fa-solid fa-right-to-bracket"></i> Sign In
                </button>

            </form>

            <a href="user_register.php"><i class="fa-solid fa-user-plus" style="margin-right: 5px;"></i>New passenger? Register account</a>

            <div style="margin-top: 20px;">
                <a class="back-btn" href="user_menu.php" style="margin-top: 0;"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

        </div>

    </div>

</body>
</html>