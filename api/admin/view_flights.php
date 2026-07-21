<?php
include(__DIR__ . '/../db.php');

// OOP Class Instantiation & Method Execution
$flightObj = new Flight($conn);
$result = $flightObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet Overview | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Fleet & Flight Directory</div>
    </div>

    <div class="container">

        <h2>Active Flight Fleet</h2>
        <p style="margin-bottom: 30px;">Overview of scheduled routes, arrival/departure timings, capacity & status.</p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Flight No</th>
                        <th>Route</th>
                        <th>Departure</th>
                        <th>Arrival</th>
                        <th>Available Seats</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if($result && mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td><strong style='color: var(--text-gold);'><i class='fa-solid fa-plane' style='margin-right: 6px;'></i>".htmlspecialchars($row['flight_no'])."</strong></td>";
                        echo "<td>".htmlspecialchars($row['source'])." <i class='fa-solid fa-arrow-right' style='color: var(--primary-gold); margin: 0 6px;'></i> ".htmlspecialchars($row['destination'])."</td>";
                        echo "<td><i class='fa-regular fa-clock' style='margin-right: 4px;'></i>".htmlspecialchars($row['departure_time'])."</td>";
                        echo "<td><i class='fa-regular fa-clock' style='margin-right: 4px;'></i>".htmlspecialchars($row['arrival_time'])."</td>";
                        echo "<td><strong style='color: #38EF7D;'>".htmlspecialchars($row['available_seats'])." Seats</strong></td>";
                        
                        $statusClass = 'color: var(--text-gold); background: rgba(212, 175, 55, 0.2);';
                        if($row['status'] == 'Cancelled') $statusClass = 'color: #FF4D4D; background: rgba(255, 77, 77, 0.2);';
                        if($row['status'] == 'Reached Destination') $statusClass = 'color: #38EF7D; background: rgba(56, 239, 125, 0.2);';

                        echo "<td><span style='".$statusClass." padding: 4px 12px; border-radius: 12px; font-weight: 600;'>".htmlspecialchars($row['status'])."</span></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='6' style='padding: 30px;'>No flights currently scheduled in the fleet.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 35px;">
            <a href="admin_dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Back to Control Center</a>
        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>