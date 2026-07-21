<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passenger Registration | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Create Account</div>
    </div>

    <div class="auth-container">

        <div class="auth-card">

            <i class="fa-solid fa-user-plus" style="font-size: 45px; color: var(--primary-gold); margin-bottom: 15px;"></i>
            <h2>Create Account</h2>
            <p style="margin-bottom: 25px; font-size: 13px;">Register for flight booking & travel privileges</p>

            <form action="user_insert.php" method="POST">

                <div class="form-group">
                    <label><i class="fa-solid fa-user" style="margin-right: 6px;"></i>Full Name</label>
                    <input type="text" name="name" placeholder="John Doe" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-envelope" style="margin-right: 6px;"></i>Email Address</label>
                    <input type="email" name="email" placeholder="john@example.com" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-lock" style="margin-right: 6px;"></i>Password</label>
                    <input type="password" name="password" placeholder="Create a strong password" required>
                </div>

                <button type="submit" style="width: 100%; margin-top: 10px;">
                    <i class="fa-solid fa-paper-plane"></i> Create Account
                </button>

            </form>

            <a href="user_login.php"><i class="fa-solid fa-right-to-bracket" style="margin-right: 5px;"></i>Already have an account? Sign in</a>

            <div style="margin-top: 20px;">
                <a class="back-btn" href="user_menu.php" style="margin-top: 0;"><i class="fa-solid fa-arrow-left"></i> Back</a>
            </div>

        </div>

    </div>

</body>
</html>