<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">
Passenger Dashboard
</div>

<div class="container">

<h3>Welcome <?php echo $_SESSION['user']; ?></h3>

<div class="grid">

<a class="card-link" href="search_flight.php">
<div class="card">
<h3>Search Flights</h3>
</div>
</a>

<a class="card-link" href="my_bookings.php">
<div class="card">
<h3>My Bookings</h3>
</div>
</a>

</div>

</div>

</body>
</html>