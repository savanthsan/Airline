<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Hostess Register</div>

<div class="auth-container">

<div class="auth-card">

<h2>Create Hostess</h2>

<form action="hostess_insert.php" method="POST">

<input name="name" placeholder="Name" required><br>
<input type="password" name="password" required><br>

<button>Register</button>

</form>

<a href="hostess_login.php">Login</a>

</div>

</div>

</body>
</html>