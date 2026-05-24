<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Passenger Register</div>

<div class="auth-container">

<div class="auth-card">

<h2>Create Account</h2>

<form action="user_insert.php" method="POST">

<input name="name" placeholder="Name" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>

<button>Register</button>

</form>

<a href="user_login.php">Already have account?</a>

</div>

</div>

</body>
</html>