<?php
include(__DIR__ . '/../db.php');

// OOP Class Instantiation & Method Execution
$staffObj = new AirportStaff($conn);
$result = $staffObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ground Staff Directory | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Ground Staff Directory</div>
    </div>

    <div class="container">

        <h2>Registered Airport Ground Staff</h2>
        <p style="margin-bottom: 30px;">Overview of registered airport ground operations personnel.</p>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if(mysqli_num_rows($result) > 0){
                    while($row=mysqli_fetch_assoc($result)){
                        echo "<tr>";
                        echo "<td><strong style='color: var(--text-gold);'>#".htmlspecialchars($row['staff_id'])."</strong></td>";
                        echo "<td><strong><i class='fa-solid fa-id-card-clip' style='color: var(--primary-gold); margin-right: 8px;'></i>".htmlspecialchars($row['name'])."</strong></td>";
                        echo "<td><span style='background: rgba(212, 175, 55, 0.2); color: var(--text-gold); padding: 4px 12px; border-radius: 12px; font-weight: 600;'>Ground Operations</span></td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='3' style='padding: 30px;'>No ground staff personnel currently registered.</td></tr>";
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