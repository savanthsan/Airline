<?php
include(__DIR__ . '/../db.php');
$result = mysqli_query($conn,"SELECT * FROM airport_staff");
?>

<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="../style.css">
</head>

<body>

<div class="navbar">Ground Staff</div>

<div class="container">

<table>

<tr>
<th>ID</th>
<th>Name</th>
</tr>

<?php
while($row=mysqli_fetch_assoc($result)){
echo "<tr>";
echo "<td>".$row['staff_id']."</td>";
echo "<td>".$row['name']."</td>";
echo "</tr>";
}
?>

</table>

</div>

</body>
</html>