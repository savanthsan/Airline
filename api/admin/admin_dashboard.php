<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">

<div>Admin Dashboard</div>

</div>

</div>

<div class="container">

<h3>Welcome <?php echo $_SESSION['admin']; ?></h3>

<div class="grid">

<a class="card-link" href="add_flight.php"><div class="card"><h3>Add Flight</h3></div></a>

<a class="card-link" href="view_flights.php"><div class="card"><h3>View Flights</h3></div></a>

<a class="card-link" href="add_pilot.php"><div class="card"><h3>Add Pilot</h3></div></a>

<a class="card-link" href="view_pilots.php"><div class="card"><h3>View Pilots</h3></div></a>

<a class="card-link" href="add_hostess.php"><div class="card"><h3>Add Hostess</h3></div></a>

<a class="card-link" href="view_hostess.php"><div class="card"><h3>View Hostess</h3></div></a>

<a class="card-link" href="add_staff.php"><div class="card"><h3>Add Staff</h3></div></a>

<a class="card-link" href="view_staff.php"><div class="card"><h3>View Staff</h3></div></a>

<a class="card-link" href="assign_staff.php"><div class="card"><h3>Assign Staff</h3></div></a>

<a class="card-link" href="delete_staff.php"><div class="card"><h3>Delete Staff</h3></div></a>
<a href="update_flight_status.php" class="card-link">
    <div class="card">
        <h3>Update Flight Status</h3>
    </div>
</a>

</div>

</div>

</body>
</html>