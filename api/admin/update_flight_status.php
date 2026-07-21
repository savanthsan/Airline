<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// OOP Class Instantiation
$flightObj = new Flight($conn);
$message = "";

if(isset($_POST['update'])){
    $flight_id = $_POST['flight_id'];
    $status = $_POST['status'];

    if($flightObj->updateStatus($flight_id, $status)){
        $message = "<p class='success'>Flight status updated successfully! ✅</p>";
    } else {
        $message = "<p class='error'>Failed to update flight status. ❌</p>";
    }
}

$flights = $flightObj->getAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Flight Status | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Flight Dispatch Control</div>
    </div>

    <div class="container">

        <h2>Update Flight Status</h2>
        <p style="margin-bottom: 30px;">Set real-time status (On Time, Delayed, Cancelled, Reached Destination) for active flights.</p>

        <div style="background: var(--bg-card); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); padding: 35px; border-radius: 20px; max-width: 550px; margin: 0 auto;">

            <?php echo $message; ?>

            <form method="POST">

                <div class="form-group">
                    <label><i class="fa-solid fa-plane" style="margin-right: 6px;"></i>Select Flight</label>
                    <select name="flight_id" required>
                        <option value="">-- Choose Flight --</option>
                        <?php while($row = mysqli_fetch_assoc($flights)){ ?>
                            <option value="<?php echo $row['flight_id']; ?>">
                                <?php echo $row['flight_no']." (".$row['source']." → ".$row['destination'].") - Current: ".$row['status']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group">
                    <label><i class="fa-solid fa-clock-rotate-left" style="margin-right: 6px;"></i>New Status</label>
                    <select name="status" required>
                        <option value="On Time">On Time</option>
                        <option value="Delayed">Delayed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Reached Destination">Reached Destination</option>
                    </select>
                </div>

                <button type="submit" name="update" style="width: 100%; margin-top: 15px;">
                    <i class="fa-solid fa-rotate"></i> Update Flight Status
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