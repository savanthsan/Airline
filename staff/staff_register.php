<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Ground Staff Register</div>

<div class="auth-container">

<div class="auth-card">

<h2>Create Account</h2>

<form action="staff_insert.php" method="POST">

<input name="name" placeholder="Name" required><br>
<input type="password"  placeholder="Password" name="password" required><br>

<button>Register</button>

</form>

<a href="staff_login.php">Login</a>

</div>

</div>

</body>
</html>