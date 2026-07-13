<?php
session_start();
include(__DIR__ . '/../db.php');

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

if(isset($_GET['id'])){
    $booking_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Get the flight_id for this booking
    $query = mysqli_query($conn, "SELECT flight_id FROM booking WHERE booking_id='$booking_id' AND passenger_id='$user_id'");
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        $flight_id = $row['flight_id'];

        // Delete booking
        mysqli_query($conn, "DELETE FROM booking WHERE booking_id='$booking_id' AND passenger_id='$user_id'");

        // Increase available seats
        mysqli_query($conn, "UPDATE flight SET available_seats = available_seats + 1 WHERE flight_id='$flight_id'");
    }
}

header("Location: my_bookings.php");
exit();
?>
