<?php
require_once __DIR__ . '/autoload.php';

// Instantiate Database class to establish connection (OOP Approach)
$database = new Database();
$conn = $database->connect();
?>