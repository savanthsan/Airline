<?php
// Database setup & Seeder Script
$host = getenv('DB_HOST') ?: "localhost";
$user = getenv('DB_USER') ?: "root";
$pass = getenv('DB_PASSWORD') ?: "";
$port = getenv('DB_PORT') ?: "3306";
$dbname = getenv('DB_NAME') ?: "airline_db";

echo "Connecting to MySQL server at $host:$port...\n";

$conn = @mysqli_connect($host, $user, $pass, "", $port);

if (!$conn) {
    echo "ERROR: Unable to connect to MySQL: " . mysqli_connect_error() . "\n";
    echo "Please make sure your MySQL server (XAMPP / WAMP / MySQL Service) is running!\n";
    exit(1);
}

// 1. Create database
$sql = "CREATE DATABASE IF NOT EXISTS `$dbname` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
if (mysqli_query($conn, $sql)) {
    echo "Database '$dbname' ensured successfully.\n";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "\n";
}

mysqli_select_db($conn, $dbname);

// 2. Create Tables
$tables = [
    "admin" => "CREATE TABLE IF NOT EXISTS `admin` (
        `admin_id` INT AUTO_INCREMENT PRIMARY KEY,
        `username` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "passenger" => "CREATE TABLE IF NOT EXISTS `passenger` (
        `passenger_id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL,
        `email` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "pilot" => "CREATE TABLE IF NOT EXISTS `pilot` (
        `pilot_id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "hostess" => "CREATE TABLE IF NOT EXISTS `hostess` (
        `hostess_id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "airport_staff" => "CREATE TABLE IF NOT EXISTS `airport_staff` (
        `staff_id` INT AUTO_INCREMENT PRIMARY KEY,
        `name` VARCHAR(255) NOT NULL UNIQUE,
        `password` VARCHAR(255) NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "flight" => "CREATE TABLE IF NOT EXISTS `flight` (
        `flight_id` INT AUTO_INCREMENT PRIMARY KEY,
        `flight_no` VARCHAR(50) NOT NULL UNIQUE,
        `source` VARCHAR(255) NOT NULL,
        `destination` VARCHAR(255) NOT NULL,
        `departure_time` TIME NOT NULL,
        `arrival_time` TIME NOT NULL,
        `total_seats` INT NOT NULL,
        `available_seats` INT NOT NULL,
        `status` VARCHAR(50) NOT NULL DEFAULT 'On Time'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "booking" => "CREATE TABLE IF NOT EXISTS `booking` (
        `booking_id` INT AUTO_INCREMENT PRIMARY KEY,
        `passenger_id` INT NOT NULL,
        `flight_id` INT NOT NULL,
        `booking_code` VARCHAR(50) NOT NULL,
        `seat_no` VARCHAR(50) NOT NULL,
        FOREIGN KEY (`passenger_id`) REFERENCES `passenger`(`passenger_id`) ON DELETE CASCADE,
        FOREIGN KEY (`flight_id`) REFERENCES `flight`(`flight_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    "staff_schedule" => "CREATE TABLE IF NOT EXISTS `staff_schedule` (
        `schedule_id` INT AUTO_INCREMENT PRIMARY KEY,
        `flight_id` INT NOT NULL UNIQUE,
        `pilot_id` INT NOT NULL,
        `hostess_id` INT NOT NULL,
        `staff_id` INT NOT NULL,
        FOREIGN KEY (`flight_id`) REFERENCES `flight`(`flight_id`) ON DELETE CASCADE,
        FOREIGN KEY (`pilot_id`) REFERENCES `pilot`(`pilot_id`) ON DELETE CASCADE,
        FOREIGN KEY (`hostess_id`) REFERENCES `hostess`(`hostess_id`) ON DELETE CASCADE,
        FOREIGN KEY (`staff_id`) REFERENCES `airport_staff`(`staff_id`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;"
];

foreach ($tables as $name => $query) {
    if (mysqli_query($conn, $query)) {
        echo "Table '$name' checked/created.\n";
    } else {
        echo "Error creating table '$name': " . mysqli_error($conn) . "\n";
    }
}

// 3. Seed Admin
mysqli_query($conn, "INSERT INTO `admin` (`username`, `password`) VALUES ('admin', 'admin123') ON DUPLICATE KEY UPDATE `username`=`username`");

// 4. Seed Passengers
$passengers = [
    ['John Doe', 'john@example.com', 'john123'],
    ['Sarah Connor', 'sarah@example.com', 'sarah123'],
    ['Alex Mercer', 'alex@example.com', 'alex123'],
    ['Emily Watson', 'emily@example.com', 'emily123'],
    ['Michael Scott', 'michael@example.com', 'michael123']
];
foreach ($passengers as $p) {
    $stmt = mysqli_prepare($conn, "INSERT INTO `passenger` (`name`, `email`, `password`) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE `name`=VALUES(`name`)");
    mysqli_stmt_bind_param($stmt, "sss", $p[0], $p[1], $p[2]);
    mysqli_stmt_execute($stmt);
}

// 5. Seed Pilots
$pilots = [
    ['Captain James Miller', 'pilot123'],
    ['Captain Amelia Vance', 'pilot123'],
    ['Captain Robert Sterling', 'pilot123'],
    ['Captain Helena Rostova', 'pilot123']
];
foreach ($pilots as $pi) {
    $stmt = mysqli_prepare($conn, "INSERT INTO `pilot` (`name`, `password`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `name`=VALUES(`name`)");
    mysqli_stmt_bind_param($stmt, "ss", $pi[0], $pi[1]);
    mysqli_stmt_execute($stmt);
}

// 6. Seed Hostesses
$hostesses = [
    ['Sophia Martinez', 'crew123'],
    ['Jessica Taylor', 'crew123'],
    ['Olivia Brown', 'crew123'],
    ['Emma Wilson', 'crew123']
];
foreach ($hostesses as $h) {
    $stmt = mysqli_prepare($conn, "INSERT INTO `hostess` (`name`, `password`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `name`=VALUES(`name`)");
    mysqli_stmt_bind_param($stmt, "ss", $h[0], $h[1]);
    mysqli_stmt_execute($stmt);
}

// 7. Seed Ground Staff
$staffs = [
    ['David Clark', 'staff123'],
    ['Daniel Lewis', 'staff123'],
    ['Rachel Adams', 'staff123'],
    ['Christopher Evans', 'staff123']
];
foreach ($staffs as $st) {
    $stmt = mysqli_prepare($conn, "INSERT INTO `airport_staff` (`name`, `password`) VALUES (?, ?) ON DUPLICATE KEY UPDATE `name`=VALUES(`name`)");
    mysqli_stmt_bind_param($stmt, "ss", $st[0], $st[1]);
    mysqli_stmt_execute($stmt);
}

// 8. Seed Flights
$flights = [
    ['AS-101', 'Dubai', 'London', '08:00:00', '12:30:00', 250, 246, 'On Time'],
    ['AS-202', 'New York', 'Paris', '14:15:00', '22:45:00', 180, 178, 'On Time'],
    ['AS-303', 'Tokyo', 'Sydney', '06:30:00', '18:00:00', 200, 199, 'Delayed'],
    ['AS-404', 'Singapore', 'Frankfurt', '23:00:00', '05:30:00', 300, 300, 'On Time'],
    ['AS-505', 'Los Angeles', 'Tokyo', '11:00:00', '16:30:00', 220, 219, 'Reached Destination'],
    ['AS-606', 'Mumbai', 'Dubai', '09:45:00', '11:30:00', 190, 190, 'Cancelled']
];
foreach ($flights as $fl) {
    $stmt = mysqli_prepare($conn, "INSERT INTO `flight` (`flight_no`, `source`, `destination`, `departure_time`, `arrival_time`, `total_seats`, `available_seats`, `status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE `status`=VALUES(`status`), `available_seats`=VALUES(`available_seats`)");
    mysqli_stmt_bind_param($stmt, "sssssiis", $fl[0], $fl[1], $fl[2], $fl[3], $fl[4], $fl[5], $fl[6], $fl[7]);
    mysqli_stmt_execute($stmt);
}

// 9. Seed Bookings
// Get IDs
$resP = mysqli_query($conn, "SELECT passenger_id, name FROM passenger");
$pMap = [];
while ($row = mysqli_fetch_assoc($resP)) {
    $pMap[$row['name']] = $row['passenger_id'];
}

$resF = mysqli_query($conn, "SELECT flight_id, flight_no FROM flight");
$fMap = [];
while ($row = mysqli_fetch_assoc($resF)) {
    $fMap[$row['flight_no']] = $row['flight_id'];
}

if (isset($pMap['John Doe']) && isset($fMap['AS-101'])) {
    mysqli_query($conn, "INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES ({$pMap['John Doe']}, {$fMap['AS-101']}, 'BK-78901', '12A')");
    mysqli_query($conn, "INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES ({$pMap['John Doe']}, {$fMap['AS-202']}, 'BK-45210', '04B')");
}
if (isset($pMap['Sarah Connor']) && isset($fMap['AS-101'])) {
    mysqli_query($conn, "INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES ({$pMap['Sarah Connor']}, {$fMap['AS-101']}, 'BK-99381', '12B')");
}
if (isset($pMap['Alex Mercer']) && isset($fMap['AS-303'])) {
    mysqli_query($conn, "INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES ({$pMap['Alex Mercer']}, {$fMap['AS-303']}, 'BK-11029', '22F')");
}
if (isset($pMap['Emily Watson']) && isset($fMap['AS-505'])) {
    mysqli_query($conn, "INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES ({$pMap['Emily Watson']}, {$fMap['AS-505']}, 'BK-33910', '01A')");
}

// 10. Seed Staff Schedules
$resPi = mysqli_query($conn, "SELECT pilot_id, name FROM pilot");
$piMap = [];
while ($row = mysqli_fetch_assoc($resPi)) {
    $piMap[$row['name']] = $row['pilot_id'];
}

$resH = mysqli_query($conn, "SELECT hostess_id, name FROM hostess");
$hMap = [];
while ($row = mysqli_fetch_assoc($resH)) {
    $hMap[$row['name']] = $row['hostess_id'];
}

$resSt = mysqli_query($conn, "SELECT staff_id, name FROM airport_staff");
$stMap = [];
while ($row = mysqli_fetch_assoc($resSt)) {
    $stMap[$row['name']] = $row['staff_id'];
}

if (isset($fMap['AS-101']) && isset($piMap['Captain James Miller']) && isset($hMap['Sophia Martinez']) && isset($stMap['David Clark'])) {
    mysqli_query($conn, "INSERT INTO `staff_schedule` (`flight_id`, `pilot_id`, `hostess_id`, `staff_id`) VALUES ({$fMap['AS-101']}, {$piMap['Captain James Miller']}, {$hMap['Sophia Martinez']}, {$stMap['David Clark']}) ON DUPLICATE KEY UPDATE `pilot_id`=VALUES(`pilot_id`)");
}
if (isset($fMap['AS-202']) && isset($piMap['Captain Amelia Vance']) && isset($hMap['Jessica Taylor']) && isset($stMap['Daniel Lewis'])) {
    mysqli_query($conn, "INSERT INTO `staff_schedule` (`flight_id`, `pilot_id`, `hostess_id`, `staff_id`) VALUES ({$fMap['AS-202']}, {$piMap['Captain Amelia Vance']}, {$hMap['Jessica Taylor']}, {$stMap['Daniel Lewis']}) ON DUPLICATE KEY UPDATE `pilot_id`=VALUES(`pilot_id`)");
}

echo "SUCCESS: All sample data populated successfully into 'airline_db'!\n";
