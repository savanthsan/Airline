<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// OOP Class Instantiations
$scheduleObj = new Schedule($conn);
$flightObj = new Flight($conn);
$pilotObj = new Pilot($conn);
$hostessObj = new Hostess($conn);
$staffObj = new AirportStaff($conn);

$message = "";

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['assign'])){
    $flight_id = $_POST['flight'];
    $pilot_id = $_POST['pilot'];
    $hostess_id = $_POST['hostess'];
    $staff_id = $_POST['staff'];

    // Call OOP Schedule method
    if($scheduleObj->assign($flight_id, $pilot_id, $hostess_id, $staff_id)){
        $message = "<p class='success'>Staff assigned successfully! ✅</p>";
    } else {
        $message = "<p class='error'>Failed to assign staff. ❌</p>";
    }
}

$flights = $flightObj->getAll();
$pilots = $pilotObj->getAll();
$hostess = $hostessObj->getAll();
$staff = $staffObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assign Staff | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Crew Roster Dispatch</div>
    </div>

    <div class="container">

        <h2>Assign Crew & Staff</h2>
        <p style="margin-bottom: 30px;">Dispatch Captain, Cabin Crew, and Ground Staff to scheduled flight routes.</p>

        <div style="background: var(--bg-card); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); padding: 35px; border-radius: 20px; max-width: 600px; margin: 0 auto;">

            <?php echo $message; ?>

            <form method="POST">

                <div class="form-group">
                    <label><i class="fa-solid fa-plane" style="margin-right: 6px;"></i>Select Flight Route</label>
                    <select name="flight" required>
                        <?php while($f=mysqli_fetch_assoc($flights)){
                            echo "<option value='".$f['flight_id']."'>".$f['flight_no']." (".$f['source']." → ".$f['destination'].")</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-user-tie" style="margin-right: 6px;"></i>Select Captain / Pilot</label>
                    <select name="pilot" required>
                        <?php while($p=mysqli_fetch_assoc($pilots)){
                            echo "<option value='".$p['pilot_id']."'>".$p['name']."</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-vest-patches" style="margin-right: 6px;"></i>Select Cabin Crew (Hostess)</label>
                    <select name="hostess" required>
                        <?php while($h=mysqli_fetch_assoc($hostess)){
                            echo "<option value='".$h['hostess_id']."'>".$h['name']."</option>";
                        } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-id-card-clip" style="margin-right: 6px;"></i>Select Airport Ground Staff</label>
                    <select name="staff" required>
                        <?php while($s=mysqli_fetch_assoc($staff)){
                            echo "<option value='".$s['staff_id']."'>".$s['name']."</option>";
                        } ?>
                    </select>
                </div>

                <button type="submit" name="assign" style="width: 100%; margin-top: 15px;">
                    <i class="fa-solid fa-clipboard-check"></i> Assign Roster
                </button>

            </form>

            <div style="margin-top: 25px;">
                <a href="admin_dashboard.php" class="back-btn" style="margin-top: 0;"><i class="fa-solid fa-arrow-left"></i> Back to Dashboard</a>
            </div>

        </div>

    </div>

    <div class="footer">
        <p>© 2026 <span>Airline Management System</span>. All rights reserved.</p>
    </div>

</body>
</html>