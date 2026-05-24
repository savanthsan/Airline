<?php

include("../db.php");

$name=$_POST['name'];
$password=$_POST['password'];

mysqli_query($conn,

"INSERT INTO airport_staff(name,password)
VALUES('$name','$password')");

header("Location:view_staff.php");

?>