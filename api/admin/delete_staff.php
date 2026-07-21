<?php
session_start();
include(__DIR__ . '/../db.php');

if(!isset($_SESSION['admin'])){
    header("Location: admin_login.php");
    exit();
}

// OOP Class Instantiations
$scheduleObj = new Schedule($conn);
$pilotObj = new Pilot($conn);
$hostessObj = new Hostess($conn);
$staffObj = new AirportStaff($conn);

$type = "";
$result = null;
$message = "";

// STEP 1: Show staff list using OOP methods
if(isset($_POST['type'])){
    $type = $_POST['type'];

    if($type == "pilot"){
        $result = $pilotObj->getAll();
    } else if($type == "hostess"){
        $result = $hostessObj->getAll();
    } else if($type == "staff"){
        $result = $staffObj->getAll();
    }
}

// STEP 2: Delete with safety check using OOP Schedule class methods
if(isset($_POST['delete'])){
    $type = $_POST['type'];
    $id = $_POST['id'];

    if($scheduleObj->isAssigned($type, $id)){
        $message = "<p class='error'>❌ Cannot delete: Personnel is currently assigned to an active flight schedule.</p>";
    } else {
        $scheduleObj->deleteStaffAssignment($type, $id);
        $message = "<p class='success'>✅ Personnel deleted successfully.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Personnel | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="navbar">
        <a href="../index.php" class="navbar-brand">
            <i class="fa-solid fa-plane-departure"></i>
            <span>AIRLINE SYSTEM</span>
        </a>
        <div class="navbar-tagline">Personnel Management</div>
    </div>

    <div class="container">

        <h2>Deactivate Personnel Account</h2>
        <p style="margin-bottom: 30px;">Remove pilot, cabin crew, or ground staff records (with assignment protection).</p>

        <div style="background: var(--bg-card); backdrop-filter: blur(20px); border: 1px solid var(--glass-border); padding: 35px; border-radius: 20px; max-width: 650px; margin: 0 auto 40px;">

            <?php echo $message; ?>

            <form method="POST" style="margin-bottom: 25px;">

                <div class="form-group">
                    <label><i class="fa-solid fa-user-gear" style="margin-right: 6px;"></i>Select Personnel Category</label>
                    <select name="type" required>
                        <option value="">-- Choose Category --</option>
                        <option value="pilot" <?php if($type=='pilot') echo 'selected'; ?>>Pilot / Captain</option>
                        <option value="hostess" <?php if($type=='hostess') echo 'selected'; ?>>Cabin Crew (Hostess)</option>
                        <option value="staff" <?php if($type=='staff') echo 'selected'; ?>>Ground Operations Staff</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-gold" style="width: 100%;">
                    <i class="fa-solid fa-list"></i> Fetch Personnel List
                </button>

            </form>

            <?php if($result && mysqli_num_rows($result) > 0){ ?>

                <form method="POST">

                    <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">

                    <div class="form-group">
                        <label><i class="fa-solid fa-user-minus" style="margin-right: 6px;"></i>Select Staff Member to Remove</label>
                        <select name="id" required>
                            <?php while($row = mysqli_fetch_assoc($result)){ 
                                $idCol = ($type=='pilot') ? 'pilot_id' : (($type=='hostess') ? 'hostess_id' : 'staff_id');
                            ?>
                                <option value="<?php echo $row[$idCol]; ?>"><?php echo htmlspecialchars($row['name']); ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <button type="submit" name="delete" class="btn" style="width: 100%; background: var(--primary-red);" onclick="return confirm('Are you sure you want to remove this staff member?');">
                        <i class="fa-solid fa-trash"></i> Confirm Deletion
                    </button>

                </form>

            <?php } elseif(isset($_POST['type'])) { ?>
                <p class="error" style="margin-top: 15px;">No personnel found in this category.</p>
            <?php } ?>

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