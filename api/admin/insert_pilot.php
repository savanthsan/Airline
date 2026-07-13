<?php

include(__DIR__ . '/../db.php');

$name=$_POST['name'];
$password=$_POST['password'];

mysqli_query($conn,

"INSERT INTO pilot(name,password)
VALUES('$name','$password')");

header("Location:view_pilots.php");

?>