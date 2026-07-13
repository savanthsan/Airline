<?php

session_start();
include(__DIR__ . '/../db.php');

$type = "";
$result = null;
$message = "";

// STEP 1: Show staff list
if(isset($_POST['type'])){

$type = $_POST['type'];

if($type == "pilot"){
$result = mysqli_query($conn,"SELECT * FROM pilot");
}

else if($type == "hostess"){
$result = mysqli_query($conn,"SELECT * FROM hostess");
}

else if($type == "staff"){
$result = mysqli_query($conn,"SELECT * FROM airport_staff");
}

}

// STEP 2: Delete with safety check
if(isset($_POST['delete'])){

$type = $_POST['type'];
$id = $_POST['id'];

// PILOT
if($type == "pilot"){

$check = mysqli_query($conn,
"SELECT * FROM staff_schedule WHERE pilot_id='$id'");

if(mysqli_num_rows($check) > 0){

$message = "❌ Cannot delete: Pilot is assigned to a flight";

}
else{

mysqli_query($conn,
"DELETE FROM pilot WHERE pilot_id='$id'");

$message = "✅ Pilot deleted successfully";

}
}

// HOSTESS
else if($type == "hostess"){

$check = mysqli_query($conn,
"SELECT * FROM staff_schedule WHERE hostess_id='$id'");

if(mysqli_num_rows($check) > 0){

$message = "❌ Cannot delete: Hostess is assigned to a flight";

}
else{

mysqli_query($conn,
"DELETE FROM hostess WHERE hostess_id='$id'");

$message = "✅ Hostess deleted successfully";

}
}

// GROUND STAFF
else if($type == "staff"){

$check = mysqli_query($conn,
"SELECT * FROM staff_schedule WHERE staff_id='$id'");

if(mysqli_num_rows($check) > 0){

$message = "❌ Cannot delete: Staff is assigned to a flight";

}
else{

mysqli_query($conn,
"DELETE FROM airport_staff WHERE staff_id='$id'");

$message = "✅ Staff deleted successfully";

}
}

}

?>

<!DOCTYPE html>
<html>

<head>

<title>Delete Staff</title>

<link rel="stylesheet" href="../style.css">

</head>

<body>

<div class="navbar">
<h2>Delete Staff</h2>
</div>

<div class="container">

<h3>Select Staff Type</h3>

<!-- STEP 3: SELECT TYPE -->

<form method="POST">

<select name="type">

<option value="pilot">Pilot</option>
<option value="hostess">Hostess</option>
<option value="staff">Ground Staff</option>

</select>

<br><br>

<button name="show">Show</button>

</form>

<br>

<!-- STEP 4: SHOW STAFF LIST -->

<?php if($result){ ?>

<form method="POST">

<input type="hidden" name="type" value="<?php echo $type; ?>">

<select name="id">

<?php

while($row = mysqli_fetch_assoc($result)){

if($type == "pilot"){
echo "<option value='".$row['pilot_id']."'>".$row['name']."</option>";
}

else if($type == "hostess"){
echo "<option value='".$row['hostess_id']."'>".$row['name']."</option>";
}

else if($type == "staff"){
echo "<option value='".$row['staff_id']."'>".$row['name']."</option>";
}

}

?>

</select>

<br><br>

<button name="delete">Delete</button>

</form>

<?php } ?>

<!-- STEP 5: SHOW MESSAGE -->

<?php
if($message != ""){
echo "<h3>$message</h3>";
}
?>

<br>

<a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</div>

</body>

</html>