<?php
session_start();
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

$result = mysqli_query($conn,
"SELECT * FROM airport_staff WHERE name='$name' AND password='$password'");
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Staff Login</div>

<div class="container">
<div class="status-card">

<?php

if(mysqli_num_rows($result)>0){

$row = mysqli_fetch_assoc($result);

$_SESSION['staff_name'] = $row['name'];

echo "<h2 class='success'>Login Successful ✅</h2>";
echo "<p>Welcome ".$row['name']."</p>";
echo "<a href='staff_dashboard.php' class='back-btn'>Dashboard</a>";

}else{

echo "<h2 class='error'>Login Failed ❌</h2>";
echo "<a href='staff_login.php' class='back-btn'>Try Again</a>";

}

?>

</div>
</div>

</body>
</html>