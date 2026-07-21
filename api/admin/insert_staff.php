<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation
$staffObj = new AirportStaff($conn);
$staffObj->add($name, $password);

header("Location: view_staff.php");
exit();
?>