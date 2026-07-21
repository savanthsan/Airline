<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation & Method Execution
$pilotObj = new Pilot($conn);
$pilotObj->add($name, $password);

header("Location: pilot_login.php");
exit();
?>