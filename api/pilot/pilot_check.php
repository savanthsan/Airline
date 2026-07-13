<?php
session_start();
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// Use Pilot class for authentication (OOP Approach)
$pilotObj = new Pilot($conn);
$row = $pilotObj->login($name, $password);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<title>Pilot Login</title>
</head>

<body>

<div class="navbar">Pilot Login</div>

<div class="container">
<div class="status-card">

<?php
if($row){
    $_SESSION['pilot_name'] = $row['name'];

    echo "<h2 class='success'>Login Successful ✅</h2>";
    echo "<p>Welcome ".$row['name']."</p>";
    echo "<a href='pilot_dashboard.php' class='back-btn'>Dashboard</a>";
}else{
    echo "<h2 class='error'>Login Failed ❌</h2>";
    echo "<a href='pilot_login.php' class='back-btn'>Try Again</a>";
}
?>

</div>
</div>

</body>
</html>