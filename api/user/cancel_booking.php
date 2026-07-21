<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

if(isset($_GET['flight'])){
    $user_id = $_SESSION['user_id'];
    $flight_id = $_GET['flight'];

    // OOP Class Instantiation
    $bookingObj = new Booking($conn);
    $flightObj = new Flight($conn);

    // Delete booking using OOP model method
    mysqli_query($conn, "DELETE FROM booking WHERE passenger_id='$user_id' AND flight_id='$flight_id'");
    $flightObj->updateSeats($flight_id, 1);
}

header("Location: my_bookings.php");
exit();
?>