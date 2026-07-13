<?php
include(__DIR__ . '/../db.php');
$result = mysqli_query($conn,"SELECT * FROM flight");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Flights</div>

<div class="container">

<table>

<tr>
<th>Flight</th>
<th>Route</th>
<th>Time</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row['flight_no']."</td>";
echo "<td>".$row['source']." → ".$row['destination']."</td>";
echo "<td>".$row['departure_time']."</td>";
echo "</tr>";
}
?>

</table>

</div>

</body>
</html>