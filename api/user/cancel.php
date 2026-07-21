<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

if(isset($_GET['id'])){
    $booking_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // OOP Class Instantiation
    $bookingObj = new Booking($conn);
    $flightObj = new Flight($conn);

    $details = $bookingObj->getDetails($booking_id, $user_id);
    if($details){
        $flight_id = $details['flight_id'];
        $bookingObj->cancel($booking_id, $user_id);
        $flightObj->updateSeats($flight_id, 1);
    }
}

header("Location: my_bookings.php");
exit();
?>
