<?php
include(__DIR__ . '/../db.php');

$name = $_POST['name'];
$password = $_POST['password'];

// OOP Class Instantiation & Method Execution
$hostessObj = new Hostess($conn);
$hostessObj->add($name, $password);

header("Location: hostess_login.php");
exit();
?>