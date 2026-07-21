<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation & Method Execution
$staffObj = new AirportStaff($conn);
$staffObj->add($name, $password);

header("Location: staff_login.php");
exit();
?>