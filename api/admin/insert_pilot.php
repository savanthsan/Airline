<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation
$pilotObj = new Pilot($conn);
$pilotObj->add($name, $password);

header("Location: view_pilots.php");
exit();
?>