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

// OOP Class Instantiation & Method Execution
$bookingObj = new Booking($conn);
$row = $bookingObj->getDetails($booking_id, $user_id);

if(!$row){
    echo "Ticket not found!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Boarding Pass | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
    <a href="../index.php" class="navbar-brand">
        <i class="fa-solid fa-plane-departure"></i>
        <span>AIRLINE SYSTEM</span>
    </a>
    <div class="navbar-tagline">Electronic Boarding Pass</div>
</div>

<div class="container">

    <!-- BOARDING PASS CARD -->
    <div class="ticket-card">

        <div class="ticket-header">
            <div class="brand">
                <i class="fa-solid fa-plane-departure" style="color: var(--primary-red); margin-right: 8px;"></i> AIRLINE BOARDING PASS
            </div>
            <div class="class-badge">CONFIRMED TICKET</div>
        </div>

        <div class="ticket-route">
            <div class="city">
                <div style="font-size: 11px; text-transform: uppercase; color: var(--text-gold); font-weight: 600;">Origin</div>
                <?php echo htmlspecialchars($row['source']); ?>
            </div>
            <div class="plane-icon">
                <i class="fa-solid fa-plane" style="transform: rotate(45deg); font-size: 28px;"></i>
            </div>
            <div class="city" style="text-align: right;">
                <div style="font-size: 11px; text-transform: uppercase; color: var(--text-gold); font-weight: 600;">Destination</div>
                <?php echo htmlspecialchars($row['destination']); ?>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(140px, 1fr)); gap: 15px; margin: 25px 0; background: rgba(0, 0, 0, 0.4); padding: 20px; border-radius: 14px; border: 1px solid rgba(212, 175, 55, 0.2);">
            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Passenger Name</span>
                <strong style="font-size: 16px; color: #FFF;"><?php echo htmlspecialchars($row['passenger_name']); ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Booking Code</span>
                <strong style="font-size: 16px; color: var(--text-gold); letter-spacing: 1px;"><?php echo htmlspecialchars($row['booking_code']); ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Flight No</span>
                <strong style="font-size: 16px; color: #FFF;"><?php echo htmlspecialchars($row['flight_no']); ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Seat Number</span>
                <strong style="font-size: 18px; color: var(--primary-gold);"><?php echo htmlspecialchars($row['seat_no']); ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Departure Time</span>
                <strong style="font-size: 15px; color: #FFF;"><i class="fa-regular fa-clock" style="margin-right: 4px;"></i><?php echo htmlspecialchars($row['departure_time']); ?></strong>
            </div>

            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase;">Arrival Time</span>
                <strong style="font-size: 15px; color: #FFF;"><i class="fa-regular fa-clock" style="margin-right: 4px;"></i><?php echo htmlspecialchars($row['arrival_time']); ?></strong>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; border-top: 1px dashed rgba(212, 175, 55, 0.4); padding-top: 20px; margin-top: 20px;">
            <div>
                <span style="display: block; font-size: 11px; color: var(--text-gold); text-transform: uppercase; margin-bottom: 4px;">Flight Status</span>
                <?php
                if($row['status'] == "Delayed"){
                    echo "<span style='background: rgba(255, 77, 77, 0.2); color: #FF4D4D; padding: 6px 14px; border-radius: 12px; font-weight: 700; display: inline-block;'><i class='fa-solid fa-clock-rotate-left' style='margin-right: 6px;'></i>Flight Delayed</span>";
                }elseif($row['status'] == "Cancelled"){
                    echo "<span style='background: rgba(255, 77, 77, 0.2); color: #FF4D4D; padding: 6px 14px; border-radius: 12px; font-weight: 700; display: inline-block;'><i class='fa-solid fa-ban' style='margin-right: 6px;'></i>Flight Cancelled (Refund Eligible)</span>";
                }elseif($row['status'] == "Reached Destination"){
                    echo "<span style='background: rgba(56, 239, 125, 0.2); color: #38EF7D; padding: 6px 14px; border-radius: 12px; font-weight: 700; display: inline-block;'><i class='fa-solid fa-circle-check' style='margin-right: 6px;'></i>Arrived</span>";
                }else{
                    echo "<span style='background: rgba(56, 239, 125, 0.2); color: #38EF7D; padding: 6px 14px; border-radius: 12px; font-weight: 700; display: inline-block;'><i class='fa-solid fa-plane-circle-check' style='margin-right: 6px;'></i>On Time</span>";
                }
                ?>
            </div>

            <!-- Simulated Barcode -->
            <div style="text-align: right;">
                <div style="font-family: monospace; letter-spacing: 3px; font-size: 22px; color: var(--text-white); background: rgba(255,255,255,0.08); padding: 8px 16px; border-radius: 8px;">
                    ||||| ||| |||| ||||| | |||
                </div>
                <span style="font-size: 10px; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Security Token: <?php echo substr(md5($row['booking_code']), 0, 10); ?></span>
            </div>
        </div>

    </div>

    <div style="margin-top: 30px;">
        <button onclick="window.print()" class="btn btn-gold" style="margin-right: 15px;"><i class="fa-solid fa-print"></i> Print Boarding Pass</button>
        <a href="my_bookings.php" class="back-btn" style="margin-top: 0;"><i class="fa-solid fa-arrow-left"></i> Back to My Bookings</a>
    </div>

</div>

<div class="footer">
    <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
</div>

</body>
</html>