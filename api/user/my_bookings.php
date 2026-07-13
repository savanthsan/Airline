<?php
session_start();
include("../db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT booking.*, flight.* 
FROM booking
JOIN flight ON booking.flight_id = flight.flight_id
WHERE booking.passenger_id='$user_id'
ORDER BY booking.booking_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Bookings</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">My Bookings</div>

<div class="container">

<table>
<tr>
    <th>Passenger</th>
    <th>Booking Code</th>
    <th>Seat No</th>
    <th>Flight No</th>
    <th>Route</th>
    <th>Departure</th>
    <th>Arrival</th>
    <th>Status</th>
    <th>Message</th>
    <th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_assoc($result)){
?>
<tr>
    <td><?php echo $_SESSION['user']; ?></td>
    <td><?php echo $row['booking_code']; ?></td>
    <td><?php echo $row['seat_no']; ?></td>
    <td><?php echo $row['flight_no']; ?></td>
    <td><?php echo $row['source']." → ".$row['destination']; ?></td>
    <td><?php echo $row['departure_time']; ?></td>
    <td><?php echo $row['arrival_time']; ?></td>
    <td><?php echo $row['status']; ?></td>

    <td>
        <?php
        if($row['status'] == "Delayed"){
            echo "<span class='error'>Your flight is delayed.</span>";
        }elseif($row['status'] == "Cancelled"){
            echo "<span class='error'>Flight cancelled. Amount will be reimbursed.</span>";
        }elseif($row['status'] == "Reached Destination"){
            echo "<span class='success'>Flight completed.</span>";
        }else{
            echo "<span class='success'>Flight is on time.</span>";
        }
        ?>
    </td>

    <td>
        <a href="ticket.php?booking_id=<?php echo $row['booking_id']; ?>" class="back-btn">View Ticket</a>

        <?php if($row['status'] == "On Time" || $row['status'] == "Delayed"){ ?>
            <a href="cancel.php?id=<?php echo $row['booking_id']; ?>" class="back-btn">Cancel</a>
        <?php }elseif($row['status'] == "Cancelled"){ ?>
            Reimbursement Pending
        <?php }else{ ?>
            Completed
        <?php } ?>
    </td>
</tr>
<?php
}
}else{
    echo "<tr><td colspan='10'>No bookings found.</td></tr>";
}
?>

</table>

<a href="user_dashboard.php" class="back-btn">Back to Dashboard</a>

</div>

</body>
</html>