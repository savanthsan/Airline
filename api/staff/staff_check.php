<?php
session_start();
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// Use AirportStaff class for authentication (OOP Approach)
$staffObj = new AirportStaff($conn);
$row = $staffObj->login($name, $password);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<title>Staff Login Status</title>
</head>

<body>

<div class="navbar">Staff Login</div>

<div class="container">
<div class="status-card">

<?php
if($row){
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