<?php
include(__DIR__ . '/../db.php');

if(isset($_POST['add'])){
    $flight_no = $_POST['flight_no'];
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $total_seats = $_POST['total_seats'];

    $sql = "INSERT INTO flight 
    (flight_no, source, destination, departure_time, arrival_time, total_seats, available_seats)
    VALUES 
    ('$flight_no', '$source', '$destination', '$departure_time', '$arrival_time', '$total_seats', '$total_seats')";

    if(mysqli_query($conn, $sql)){
        header("Location: add_flight.php?success=1");
        exit();
    }else{
        header("Location: add_flight.php?error=1");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Flight</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Add Flight</div>

<div class="container">

    <?php
    if(isset($_GET['success'])){
        echo "<p class='success'>Flight added successfully!</p>";
    }

    if(isset($_GET['error'])){
        echo "<p class='error'>Failed to add flight!</p>";
    }
    ?>

    <form method="POST">

        <input type="text" name="flight_no" placeholder="Flight Number" required>

        <input type="text" name="source" placeholder="Source" required>

        <input type="text" name="destination" placeholder="Destination" required>

        <input type="time" name="departure_time" required>

        <input type="time" name="arrival_time" required>

        <input type="number" name="total_seats" placeholder="Total Seats" required>

        <button type="submit" name="add">Add Flight</button>

    </form>

    <a href="admin_dashboard.php" class="back-btn">Back to Dashboard</a>

</div>

</body>
</html>