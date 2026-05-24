<?php
session_start();
include("../db.php");

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

$flight_query = mysqli_query($conn, "SELECT * FROM flight WHERE flight_id='$flight_id'");
$flight = mysqli_fetch_assoc($flight_query);

if(!$flight){
    echo "<script>
        alert('Flight not found!');
        window.location.href='search_flight.php';
    </script>";
    exit();
}

if($flight['status'] == "Cancelled" || $flight['status'] == "Reached Destination"){
    echo "<script>
        alert('This flight cannot be booked now!');
        window.location.href='search_flight.php';
    </script>";
    exit();
}

if($flight['available_seats'] <= 0){
    echo "<script>
        alert('Sorry, no seats available!');
        window.location.href='search_flight.php';
    </script>";
    exit();
}

$booking_code = "BK".rand(10000,99999);
$seat_no = "A".$flight['available_seats'];

$insert = mysqli_query($conn,
"INSERT INTO booking 
(passenger_id, flight_id, booking_code, seat_no)
VALUES 
('$user_id', '$flight_id', '$booking_code', '$seat_no')");

if($insert){
    mysqli_query($conn,
    "UPDATE flight 
     SET available_seats = available_seats - 1 
     WHERE flight_id='$flight_id' 
     AND available_seats > 0");

    header("Location: my_bookings.php");
    exit();
}else{
    echo "<script>
        alert('Booking failed!');
        window.location.href='search_flight.php';
    </script>";
    exit();
}
?>