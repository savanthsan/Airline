<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Passenger Login</div>

<div class="auth-container">

<div class="auth-card">

<h2>Login</h2>

<form action="user_check.php" method="POST">

<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>

<button>Login</button>

</form>

<a href="user_register.php">New user? Register</a>

</div>

</div>

</body>
</html>