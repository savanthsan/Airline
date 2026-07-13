<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: admin_login.php");
exit();
}
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
Add Pilot
</div>

<div class="container">

<form action="insert_pilot.php" method="POST">

<h3>Enter Pilot Details</h3>

<input type="text" name="name" placeholder="Pilot Name" required>

<br><br>

<input type="password" name="password" placeholder="Password" required>

<br><br>

<button class="btn">Add Pilot</button>

</form>

<br>

<a href="admin_dashboard.php" class="btn">Back</a>

</div>

</body>
</html>