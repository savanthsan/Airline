<?php
include("../db.php");

if(isset($_POST['update'])){
    $flight_id = $_POST['flight_id'];
    $status = $_POST['status'];

    mysqli_query($conn,
    "UPDATE flight SET status='$status' WHERE flight_id='$flight_id'");

    header("Location: update_flight_status.php?success=1");
    exit();
}

$flights = mysqli_query($conn, "SELECT * FROM flight");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Flight Status</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Update Flight Status</div>

<div class="container">

<?php
if(isset($_GET['success'])){
    echo "<p class='success'>Flight status updated successfully!</p>";
}
?>

<form method="POST">

    <select name="flight_id" required>
        <option value="">Select Flight</option>

        <?php while($row = mysqli_fetch_assoc($flights)){ ?>
            <option value="<?php echo $row['flight_id']; ?>">
                <?php echo $row['flight_no']." - ".$row['source']." to ".$row['destination']." - ".$row['status']; ?>
            </option>
        <?php } ?>
    </select>

    <select name="status" required>
        <option value="On Time">On Time</option>
        <option value="Delayed">Delayed</option>
        <option value="Cancelled">Cancelled</option>
        <option value="Reached Destination">Reached Destination</option>
    </select>

    <button type="submit" name="update">Update Status</button>

</form>

<a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>

</div>

</body>
</html>