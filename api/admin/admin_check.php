<?php
session_start();
include(__DIR__ . '/../db.php');

$username = $_POST['username'];
$password = $_POST['password'];

$result = mysqli_query($conn,
"SELECT * FROM admin WHERE username='$username' AND password='$password'");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Admin Login</div>

<div class="container">

<div class="status-card">

<?php

if(mysqli_num_rows($result) > 0){

$row = mysqli_fetch_assoc($result);

$_SESSION['admin'] = $row['username'];

echo "<h2 class='success'>Login Successful ✅</h2>";
echo "<p>Welcome Admin: ".$row['username']."</p>";

echo "<br><a href='admin_dashboard.php' class='back-btn'>Go to Dashboard</a>";

}else{

echo "<h2 class='error'>Login Failed ❌</h2>";
echo "<p>Invalid username or password</p>";

echo "<br><a href='admin_login.php' class='back-btn'>Try Again</a>";

}

?>

</div>

</div>

</body>

</html>