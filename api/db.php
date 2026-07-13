<?php

$db_host = getenv('DB_HOST') ?: "localhost";
$db_user = getenv('DB_USER') ?: "root";
$db_pass = getenv('DB_PASSWORD') ?: "";
$db_name = getenv('DB_NAME') ?: "airline_db";
$db_port = getenv('DB_PORT') ?: "3306";

// Create connection
$conn = mysqli_init();
if (!$conn) {
    die("mysqli_init failed");
}

$ssl_ca = getenv('DB_SSL_CA');
if ($ssl_ca) {
    $conn->ssl_set(NULL, NULL, $ssl_ca, NULL, NULL);
    $conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
    $success = $conn->real_connect($db_host, $db_user, $db_pass, $db_name, $db_port, NULL, MYSQLI_CLIENT_SSL);
} else {
    $success = $conn->real_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
}

if (!$success) {
    die("Database connection failed: " . mysqli_connect_error());
}

?>