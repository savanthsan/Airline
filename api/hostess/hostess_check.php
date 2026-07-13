<?php
session_start();
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// Use Hostess class for authentication (OOP Approach)
$hostessObj = new Hostess($conn);
$row = $hostessObj->login($name, $password);
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../style.css">
<title>Hostess Login Status</title>
</head>

<body>

<div class="navbar">Hostess Login</div>

<div class="container">
<div class="status-card">

<?php
if($row){
    $_SESSION['hostess_name'] = $row['name'];

    echo "<h2 class='success'>Login Successful ✅</h2>";
    echo "<p>Welcome ".$row['name']."</p>";
    echo "<a href='hostess_dashboard.php' class='back-btn'>Dashboard</a>";
}else{
    echo "<h2 class='error'>Login Failed ❌</h2>";
    echo "<a href='hostess_login.php' class='back-btn'>Try Again</a>";
}
?>

</div>
</div>

</body>
</html>