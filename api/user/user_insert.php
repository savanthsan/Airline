<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// OOP Class Instantiation & Method Execution
$passengerObj = new Passenger($conn);
$passengerObj->register($name, $email, $password);

header("Location: user_login.php");
exit();
?>