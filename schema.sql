-- Create Database (if not exists)
CREATE DATABASE IF NOT EXISTS `airline_db`;
USE `airline_db`;

-- 1. Admin Table
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 2. Passenger Table
CREATE TABLE IF NOT EXISTS `passenger` (
  `passenger_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. Pilot Table
CREATE TABLE IF NOT EXISTS `pilot` (
  `pilot_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 4. Hostess Table
CREATE TABLE IF NOT EXISTS `hostess` (
  `hostess_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. Airport Staff Table (Ground Staff)
CREATE TABLE IF NOT EXISTS `airport_staff` (
  `staff_id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. Flight Table
CREATE TABLE IF NOT EXISTS `flight` (
  `flight_id` INT AUTO_INCREMENT PRIMARY KEY,
  `flight_no` VARCHAR(50) NOT NULL UNIQUE,
  `source` VARCHAR(255) NOT NULL,
  `destination` VARCHAR(255) NOT NULL,
  `departure_time` TIME NOT NULL,
  `arrival_time` TIME NOT NULL,
  `total_seats` INT NOT NULL,
  `available_seats` INT NOT NULL,
  `status` VARCHAR(50) NOT NULL DEFAULT 'On Time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. Booking Table
CREATE TABLE IF NOT EXISTS `booking` (
  `booking_id` INT AUTO_INCREMENT PRIMARY KEY,
  `passenger_id` INT NOT NULL,
  `flight_id` INT NOT NULL,
  `booking_code` VARCHAR(50) NOT NULL,
  `seat_no` VARCHAR(50) NOT NULL,
  FOREIGN KEY (`passenger_id`) REFERENCES `passenger`(`passenger_id`) ON DELETE CASCADE,
  FOREIGN KEY (`flight_id`) REFERENCES `flight`(`flight_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 8. Staff Schedule Table
CREATE TABLE IF NOT EXISTS `staff_schedule` (
  `schedule_id` INT AUTO_INCREMENT PRIMARY KEY,
  `flight_id` INT NOT NULL UNIQUE,
  `pilot_id` INT NOT NULL,
  `hostess_id` INT NOT NULL,
  `staff_id` INT NOT NULL,
  FOREIGN KEY (`flight_id`) REFERENCES `flight`(`flight_id`) ON DELETE CASCADE,
  FOREIGN KEY (`pilot_id`) REFERENCES `pilot`(`pilot_id`) ON DELETE CASCADE,
  FOREIGN KEY (`hostess_id`) REFERENCES `hostess`(`hostess_id`) ON DELETE CASCADE,
  FOREIGN KEY (`staff_id`) REFERENCES `airport_staff`(`staff_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert default admin
INSERT INTO `admin` (`username`, `password`) VALUES ('admin', 'admin123')
ON DUPLICATE KEY UPDATE `username`=`username`;
