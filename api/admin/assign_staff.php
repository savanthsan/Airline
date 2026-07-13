<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign'])){
    $flight_id = $_POST['flight'];
    $pilot_id = $_POST['pilot'];
    $hostess_id = $_POST['hostess'];
    $staff_id = $_POST['staff'];

    // Check if flight already has staff assigned
    $check = mysqli_query($conn, "SELECT * FROM staff_schedule WHERE flight_id='$flight_id'");
    if(mysqli_num_rows($check) > 0){
        $sql = "UPDATE staff_schedule SET pilot_id='$pilot_id', hostess_id='$hostess_id', staff_id='$staff_id' WHERE flight_id='$flight_id'";
    } else {
        $sql = "INSERT INTO staff_schedule (flight_id, pilot_id, hostess_id, staff_id) VALUES ('$flight_id', '$pilot_id', '$hostess_id', '$staff_id')";
    }

    if(mysqli_query($conn, $sql)){
        $message = "<p class='success'>Staff assigned successfully! ✅</p>";
    } else {
        $message = "<p class='error'>Failed to assign staff: " . mysqli_error($conn) . " ❌</p>";
    }
}

$flights=mysqli_query($conn,"SELECT * FROM flight");
$pilots=mysqli_query($conn,"SELECT * FROM pilot");
$hostess=mysqli_query($conn,"SELECT * FROM hostess");
$staff=mysqli_query($conn,"SELECT * FROM airport_staff");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
<title>Assign Staff</title>
</head>

<body>

<div class="navbar">Assign Staff</div>

<div class="container">

<?php echo $message; ?>

<form method="POST">

<label>Select Flight:</label><br>
<select name="flight" required>
<?php while($f=mysqli_fetch_assoc($flights)){
echo "<option value='".$f['flight_id']."'>".$f['flight_no']." (".$f['source']." -> ".$f['destination'].")</option>";
} ?>
</select><br><br>

<label>Select Pilot:</label><br>
<select name="pilot" required>
<?php while($p=mysqli_fetch_assoc($pilots)){
echo "<option value='".$p['pilot_id']."'>".$p['name']."</option>";
} ?>
</select><br><br>

<label>Select Hostess:</label><br>
<select name="hostess" required>
<?php while($h=mysqli_fetch_assoc($hostess)){
echo "<option value='".$h['hostess_id']."'>".$h['name']."</option>";
} ?>
</select><br><br>

<label>Select Ground Staff:</label><br>
<select name="staff" required>
<?php while($s=mysqli_fetch_assoc($staff)){
echo "<option value='".$s['staff_id']."'>".$s['name']."</option>";
} ?>
</select><br><br>

<button type="submit" name="assign" class="btn">Assign</button>

</form>

<br>
<a href="admin_dashboard.php" class="back-btn">⬅ Back to Dashboard</a>

</div>

</body>
</html>