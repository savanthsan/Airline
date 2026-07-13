<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

if(!isset($_GET['booking_id'])){
    header("Location: my_bookings.php");
    exit();
}

$booking_id = $_GET['booking_id'];
$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT booking.*, flight.*, passenger.name AS passenger_name
FROM booking
JOIN flight ON booking.flight_id = flight.flight_id
JOIN passenger ON booking.passenger_id = passenger.passenger_id
WHERE booking.booking_id='$booking_id'
AND booking.passenger_id='$user_id'");

if(mysqli_num_rows($result) == 0){
    echo "Ticket not found!";
    exit();
}

$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Flight Ticket</div>

<div class="container">

<div class="auth-card">

<h2>✈ Airline Ticket</h2>

<p><b>Passenger:</b> <?php echo $row['passenger_name']; ?></p>
<p><b>Booking Code:</b> <?php echo $row['booking_code']; ?></p>
<p><b>Seat No:</b> <?php echo $row['seat_no']; ?></p>

<hr><br>

<p><b>Flight No:</b> <?php echo $row['flight_no']; ?></p>
<p><b>Route:</b> <?php echo $row['source']." → ".$row['destination']; ?></p>
<p><b>Departure:</b> <?php echo $row['departure_time']; ?></p>
<p><b>Arrival:</b> <?php echo $row['arrival_time']; ?></p>
<p><b>Status:</b> <?php echo $row['status']; ?></p>

<br>

<?php
if($row['status'] == "Delayed"){
    echo "<p class='error'>Your flight is delayed.</p>";
}elseif($row['status'] == "Cancelled"){
    echo "<p class='error'>Flight cancelled. Amount will be reimbursed.</p>";
}elseif($row['status'] == "Reached Destination"){
    echo "<p class='success'>Flight has reached the destination.</p>";
}else{
    echo "<p class='success'>Flight is on time.</p>";
}
?>

<a href="my_bookings.php" class="back-btn">Back to My Bookings</a>

</div>

</div>

</body>
</html>