<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: search_flight.php");
    exit();
}

$flight_id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// OOP Class Instantiation
$flightObj = new Flight($conn);
$bookingObj = new Booking($conn);

$flight = $flightObj->getById($flight_id);

if(!$flight){
    echo "<script>alert('Flight not found!'); window.location.href='search_flight.php';</script>";
    exit();
}

if($flight['status'] == "Cancelled" || $flight['status'] == "Reached Destination"){
    echo "<script>alert('This flight cannot be booked now!'); window.location.href='search_flight.php';</script>";
    exit();
}

if($flight['available_seats'] <= 0){
    echo "<script>alert('Sorry, no seats available!'); window.location.href='search_flight.php';</script>";
    exit();
}

$booking_code = "BK".rand(10000,99999);
$seat_no = "A".$flight['available_seats'];

// OOP Class Method Executions
$insert = $bookingObj->book($user_id, $flight_id, $booking_code, $seat_no);

if($insert){
    $flightObj->updateSeats($flight_id, -1);
    header("Location: my_bookings.php");
    exit();
}else{
    echo "<script>alert('Booking failed!'); window.location.href='search_flight.php';</script>";
    exit();
}
?>