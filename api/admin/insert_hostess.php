<?php

include(__DIR__ . '/../db.php');

$name=$_POST['name'];
$password=$_POST['password'];

mysqli_query($conn,

"INSERT INTO hostess(name,password)
VALUES('$name','$password')");

header("Location:view_hostess.php");

?>