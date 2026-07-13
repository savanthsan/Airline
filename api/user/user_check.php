<?php
session_start();
include(__DIR__ . '/../db.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Use Passenger class for authentication (OOP Approach)
$passengerObj = new Passenger($conn);
$row = $passengerObj->login($email, $password);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<title>Login Status</title>
</head>

<body>

<div class="navbar">Login Status</div>

<div class="container">

<div class="status-card">

<?php
if($row){
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