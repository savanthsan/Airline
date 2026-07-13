<?php
session_start();
include(__DIR__ . '/../db.php');

$name = $_SESSION['hostess_name'];

$h = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT * FROM hostess WHERE name='$name'"));

$id = $h['hostess_id'];

$query = "
SELECT flight.*
FROM staff_schedule
JOIN flight ON staff_schedule.flight_id = flight.flight_id
WHERE staff_schedule.hostess_id = '$id'
";

$result = mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">👩‍✈️ Hostess Dashboard</div>

<div class="container">

<h2>My Flights</h2>

<table>

<tr>
<th>Flight</th>
<th>Route</th>
<th>Departure</th>
<th>Arrival</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row['flight_no']."</td>";
echo "<td>".$row['source']." → ".$row['destination']."</td>";
echo "<td>".$row['departure_time']."</td>";
echo "<td>".$row['arrival_time']."</td>";
echo "</tr>";
}
?>

</table>

</div>

</body>
</html>