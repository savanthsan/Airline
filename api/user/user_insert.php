<?php

include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

$query = "INSERT INTO passenger(name,email,password)
VALUES('$name','$email','$password')";

mysqli_query($conn,$query);

header("Location: user_login.php");
exit();

?>