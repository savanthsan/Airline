<?php

session_start();
include(__DIR__ . '/../db.php');

// Check login
if(!isset($_SESSION['user_id'])){
header("Location: user_login.php");
exit();
}

$user_id = $_SESSION['user_id'];
$flight_id = $_GET['flight'];

// Delete booking
mysqli_query($conn,
"DELETE FROM booking 
WHERE passenger_id='$user_id' 
AND flight_id='$flight_id'");

// Increase available seats
mysqli_query($conn,
"UPDATE flight 
SET available_seats = available_seats + 1 
WHERE flight_id='$flight_id'");

// Redirect back
header("Location: my_bookings.php");
exit();

?>