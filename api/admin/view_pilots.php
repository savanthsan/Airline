<?php
include(__DIR__ . '/../db.php');

// OOP Class Instantiation & Method Execution
$pilotObj = new Pilot($conn);
$result = $pilotObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilot Directory | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Pilot Directory</div>
    </div>

    <div class="container">

        <h2>Registered Captains & Pilots</h2>
        <p style="margin-bottom: 30px;">Overview of registered cockpit pilots in the airline system.</p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Pilot ID</th>
                        <th>Captain Name</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td><strong style='color: var(--text-gold);'>#".htmlspecialchars($row['pilot_id'])."</strong></td>";
                        echo "<td><strong><i class='fa-solid fa-user-tie' style='color: var(--primary-gold); margin-right: 8px;'></i>".htmlspecialchars($row['name'])."</strong></td>";
                        echo "<td><span style='background: rgba(212, 175, 55, 0.2); color: var(--text-gold); padding: 4px 12px; border-radius: 12px; font-weight: 600;'>Flight Captain</span></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='3' style='padding: 30px;'>No pilots currently registered.</td></tr>";
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