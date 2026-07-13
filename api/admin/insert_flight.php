<?php

include("../db.php");

$f=$_POST['flight_no'];
$s=$_POST['source'];
$d=$_POST['destination'];
$dep=$_POST['departure'];
$arr=$_POST['arrival'];
$seats=$_POST['seats'];

mysqli_query($conn,

"INSERT INTO flight
(flight_no,source,destination,departure_time,arrival_time,total_seats,available_seats)

VALUES
('$f','$s','$d','$dep','$arr','$seats','$seats')");

echo "Flight Added";

?>