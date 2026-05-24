<?php
include("../db.php");

$flights=mysqli_query($conn,"SELECT * FROM flight");
$pilots=mysqli_query($conn,"SELECT * FROM pilot");
$hostess=mysqli_query($conn,"SELECT * FROM hostess");
$staff=mysqli_query($conn,"SELECT * FROM airport_staff");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Assign Staff</div>

<div class="container">

<form method="POST">

<select name="flight">
<?php while($f=mysqli_fetch_assoc($flights)){
echo "<option value='".$f['flight_id']."'>".$f['flight_no']."</option>";
} ?>
</select><br><br>

<select name="pilot">
<?php while($p=mysqli_fetch_assoc($pilots)){
echo "<option value='".$p['pilot_id']."'>".$p['name']."</option>";
} ?>
</select><br><br>

<select name="hostess">
<?php while($h=mysqli_fetch_assoc($hostess)){
echo "<option value='".$h['hostess_id']."'>".$h['name']."</option>";
} ?>
</select><br><br>

<select name="staff">
<?php while($s=mysqli_fetch_assoc($staff)){
echo "<option value='".$s['staff_id']."'>".$s['name']."</option>";
} ?>
</select><br><br>

<button class="btn">Assign</button>

</form>

</div>

</body>
</html>