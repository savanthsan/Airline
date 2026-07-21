<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['hostess_name'])){
    header("Location: hostess_login.php");
    exit();
}

$hostess_name = $_SESSION['hostess_name'];

// OOP Class Instantiation
$scheduleObj = new Schedule($conn);

$resH = mysqli_query($conn, "SELECT * FROM hostess WHERE name='" . mysqli_real_escape_string($conn, $hostess_name) . "'");
$h = mysqli_fetch_assoc($resH);
$hostess_id = $h['hostess_id'] ?? 0;

// Use Schedule OOP class method to get assigned flights
$result = $scheduleObj->getAssignedFlights('hostess', $hostess_id);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cabin Crew Roster | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="profile">
            <span><i class="fa-solid fa-vest-patches" style="color: var(--primary-gold); margin-right: 6px;"></i>Crew: <strong><?php echo htmlspecialchars($hostess_name); ?></strong></span>
            <a href="hostess_login.php" class="btn btn-gold" style="padding: 6px 14px; font-size: 12px; margin-left: 10px;"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>

    <div class="container">

        <h2>Assigned Cabin Crew Roster</h2>
        <p style="margin-bottom: 30px;">Overview of your assigned flight schedules and cabin service duties.</p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Flight No</th>
                        <th>Route</th>
                        <th>Departure</th>
                        <th>Arrival</th>
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
                        echo "<td><span style='background: rgba(212, 175, 55, 0.2); color: var(--text-gold); padding: 4px 12px; border-radius: 12px; font-weight: 600;'>".htmlspecialchars($row['status'])."</span></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='5' style='padding: 30px;'><i class='fa-solid fa-calendar-xmark' style='font-size: 32px; color: var(--text-muted); display: block; margin-bottom: 10px;'></i>No flights assigned to your cabin crew schedule yet.</td></tr>";
                }
                ?>
                </tbody>
            </table>
        </div>

        <div style="margin-top: 35px;">
            <a href="../index.php" class="back-btn"><i class="fa-solid fa-house"></i> Main Portal</a>
        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>