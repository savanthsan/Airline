<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal Login | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Administrator Control Center</div>
    </div>

    <div class="auth-container">

        <div class="auth-card">

            <i class="fa-solid fa-user-shield" style="font-size: 48px; color: var(--primary-gold); margin-bottom: 15px;"></i>
            <h2>Administrator Portal</h2>
            <p style="margin-bottom: 25px; font-size: 13px;">Secure authentication for fleet & system administrators</p>

            <form action="admin_check.php" method="POST">

                <div class="form-group">
                    <label><i class="fa-solid fa-user" style="margin-right: 6px;"></i>Admin Username</label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-key" style="margin-right: 6px;"></i>Password</label>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>

                <button type="submit" style="width: 100%; margin-top: 10px;">
                    <i class="fa-solid fa-shield-halved"></i> Authenticate Admin
                </button>

            </form>

            <div style="margin-top: 25px;">
                <a class="back-btn" href="../index.php" style="margin-top: 0;"><i class="fa-solid fa-arrow-left"></i> Back to Main Portal</a>
            </div>

        </div>

    </div>

</body>

</html>