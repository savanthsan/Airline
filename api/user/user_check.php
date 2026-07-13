<?php
session_start();
include("../db.php");

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn,
"SELECT * FROM passenger WHERE email='$email' AND password='$password'");

?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Login Status</div>

<div class="container">

<div class="status-card">

<?php

if(mysqli_num_rows($result) > 0){

$row = mysqli_fetch_assoc($result);

$_SESSION['user'] = $row['name'];
$_SESSION['user_id'] = $row['passenger_id'];

echo "<h2 class='success'>Login Successful ✅</h2>";
echo "<p>Welcome ".$row['name']."</p>";

echo "<br><a href='user_dashboard.php' class='back-btn'>Go to Dashboard</a>";

}else{

echo "<h2 class='error'>Login Failed ❌</h2>";
echo "<p>Invalid credentials</p>";

echo "<br><a href='user_login.php' class='back-btn'>Try Again</a>";

}

?>

</div>

</div>

</body>
</html>