<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Pilot Register</div>

<div class="auth-container">

<div class="auth-card">

<h2>Create Pilot</h2>

<form action="pilot_insert.php" method="POST">

<input name="name" placeholder="Name" required><br>
<input type="password" name="password" placeholder="Password" required><br>

<button>Register</button>

</form>

<a href="pilot_login.php">Login</a>

</div>

</div>

</body>
</html>