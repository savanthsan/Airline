<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['user_id'])){
    header("Location: user_login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// OOP Class Instantiation & Method Execution
$bookingObj = new Booking($conn);
$result = $bookingObj->getByPassenger($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings | Airline Management System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
    <a href="../index.php" class="navbar-brand">
        <i class="fa-solid fa-plane-departure"></i>
        <span>AIRLINE SYSTEM</span>
    </a>
    <div class="navbar-tagline">My Reservations</div>
</div>

<div class="container">

    <h2>My Flight Reservations</h2>
    <p style="margin-bottom: 30px;">View confirmed tickets, check real-time flight status, and print boarding passes.</p>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Passenger</th>
                    <th>Booking Code</th>
                    <th>Seat No</th>
                    <th>Flight No</th>
                    <th>Route</th>
                    <th>Schedule</th>
                    <th>Status</th>
                    <th>Notice</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><strong><i class="fa-solid fa-user" style="color: var(--primary-gold); margin-right: 6px;"></i><?php echo htmlspecialchars($_SESSION['user']); ?></strong></td>
                    <td><span style="font-family: monospace; letter-spacing: 1px; color: var(--text-gold); font-weight: 700;"><?php echo htmlspecialchars($row['booking_code']); ?></span></td>
                    <td><strong style="color: var(--primary-gold);"><?php echo htmlspecialchars($row['seat_no']); ?></strong></td>
                    <td><strong><?php echo htmlspecialchars($row['flight_no']); ?></strong></td>
                    <td><?php echo htmlspecialchars($row['source'])." <i class='fa-solid fa-arrow-right' style='color: var(--primary-gold); margin: 0 4px;'></i> ".htmlspecialchars($row['destination']); ?></td>
                    <td style="font-size: 13px;">
                        <div>Dep: <?php echo htmlspecialchars($row['departure_time']); ?></div>
                        <div>Arr: <?php echo htmlspecialchars($row['arrival_time']); ?></div>
                    </td>
                    <td>
                        <?php
                        if($row['status'] == "Delayed"){
                            echo "<span style='background: rgba(255, 77, 77, 0.2); color: #FF4D4D; padding: 4px 10px; border-radius: 12px; font-weight: 600;'>Delayed</span>";
                        }elseif($row['status'] == "Cancelled"){
                            echo "<span style='background: rgba(255, 77, 77, 0.2); color: #FF4D4D; padding: 4px 10px; border-radius: 12px; font-weight: 600;'>Cancelled</span>";
                        }elseif($row['status'] == "Reached Destination"){
                            echo "<span style='background: rgba(56, 239, 125, 0.2); color: #38EF7D; padding: 4px 10px; border-radius: 12px; font-weight: 600;'>Completed</span>";
                        }else{
                            echo "<span style='background: rgba(56, 239, 125, 0.2); color: #38EF7D; padding: 4px 10px; border-radius: 12px; font-weight: 600;'>On Time</span>";
                        }
                        ?>
                    </td>

                    <td style="font-size: 13px;">
                        <?php
                        if($row['status'] == "Delayed"){
                            echo "<span class='error'><i class='fa-solid fa-triangle-exclamation'></i> Flight delayed</span>";
                        }elseif($row['status'] == "Cancelled"){
                            echo "<span class='error'><i class='fa-solid fa-ban'></i> Refund in progress</span>";
                        }elseif($row['status'] == "Reached Destination"){
                            echo "<span class='success'><i class='fa-solid fa-circle-check'></i> Destination reached</span>";
                        }else{
                            echo "<span class='success'><i class='fa-solid fa-circle-check'></i> Ready for boarding</span>";
                        }
                        ?>
                    </td>

                    <td>
                        <a href="ticket.php?booking_id=<?php echo $row['booking_id']; ?>" class="btn btn-gold" style="padding: 6px 12px; font-size: 12px; margin-bottom: 4px; display: inline-block;">
                            <i class="fa-solid fa-ticket"></i> Ticket
                        </a>

                        <?php if($row['status'] == "On Time" || $row['status'] == "Delayed"){ ?>
                            <a href="cancel.php?id=<?php echo $row['booking_id']; ?>" class="btn" style="padding: 6px 12px; font-size: 12px; background: rgba(215, 25, 33, 0.8); display: inline-block;" onclick="return confirm('Are you sure you want to cancel this booking?');">
                                <i class="fa-solid fa-xmark"></i> Cancel
                            </a>
                        <?php }elseif($row['status'] == "Cancelled"){ ?>
                            <span style="font-size: 11px; color: var(--text-muted);">Cancelled</span>
                        <?php }else{ ?>
                            <span style="font-size: 11px; color: var(--text-muted);">Done</span>
                        <?php } ?>
                    </td>
                </tr>
            <?php
                }
            }else{
                echo "<tr><td colspan='9' style='padding: 30px;'><i class='fa-solid fa-ticket-simple' style='font-size: 32px; color: var(--text-muted); display: block; margin-bottom: 10px;'></i>No active flight bookings found.</td></tr>";
            }
            ?>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 35px;">
        <a href="user_dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
    </div>

</div>

<div class="footer">
    <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
</div>

</body>
</html>