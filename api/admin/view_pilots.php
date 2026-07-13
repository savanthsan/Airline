<?php
include("../db.php");
$result = mysqli_query($conn,"SELECT * FROM pilot");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Pilots</div>

<div class="container">

<table>

<tr>
<th>ID</th>
<th>Name</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row['pilot_id']."</td>";
echo "<td>".$row['name']."</td>";
echo "</tr>";
}
?>

</table>

</div>

</body>
</html>