<?php
include(__DIR__ . '/../db.php');

$f = $_POST['flight_no'];
$s = $_POST['source'];
$d = $_POST['destination'];
$dep = $_POST['departure'];
$arr = $_POST['arrival'];
$seats = $_POST['seats'];

// OOP Class Instantiation
$flightObj = new Flight($conn);
$result = $flightObj->add($f, $s, $d, $dep, $arr, $seats);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Status | Airline System</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <div class="navbar"><i class="fa-solid fa-plane"></i> Flight Operations</div>
    <div class="container">
        <div class="status-card">
            <?php if($result): ?>
                <h2 class="success"><i class="fa-solid fa-circle-check"></i> Flight Added Successfully</h2>
                <p>Flight <strong><?php echo htmlspecialchars($f); ?></strong> has been scheduled.</p>
            <?php else: ?>
                <h2 class="error"><i class="fa-solid fa-triangle-exclamation"></i> Error Adding Flight</h2>
                <p>Failed to add flight into system.</p>
            <?php endif; ?>
            <a href="admin_dashboard.php" class="back-btn"><i class="fa-solid fa-arrow-left"></i> Return to Dashboard</a>
        </div>
    </div>
</body>
</html>