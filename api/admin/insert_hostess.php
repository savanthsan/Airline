<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation
$hostessObj = new Hostess($conn);
$hostessObj->add($name, $password);

header("Location: view_hostess.php");
exit();
?>