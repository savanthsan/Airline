<?php

include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

$query = "INSERT INTO pilot(name,password)
VALUES('$name','$password')";

mysqli_query($conn,$query);

header("Location: pilot_login.php");
exit();

?>