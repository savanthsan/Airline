-- ===== AIRLINE SYSTEM RAILWAY DATABASE INITIALIZATION & SAMPLE DATA =====

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

-- ===== SAMPLE DATA INSERTIONS =====

-- Admin
INSERT INTO `admin` (`username`, `password`) VALUES ('admin', 'admin123')
ON DUPLICATE KEY UPDATE `username`=`username`;

-- Passengers
INSERT INTO `passenger` (`name`, `email`, `password`) VALUES
('John Doe', 'john@example.com', 'john123'),
('Sarah Connor', 'sarah@example.com', 'sarah123'),
('Alex Mercer', 'alex@example.com', 'alex123'),
('Emily Watson', 'emily@example.com', 'emily123')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

-- Pilots
INSERT INTO `pilot` (`name`, `password`) VALUES
('Captain James Miller', 'pilot123'),
('Captain Amelia Vance', 'pilot123'),
('Captain Robert Sterling', 'pilot123')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

-- Hostesses
INSERT INTO `hostess` (`name`, `password`) VALUES
('Sophia Martinez', 'crew123'),
('Jessica Taylor', 'crew123'),
('Olivia Brown', 'crew123')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

-- Airport Staff
INSERT INTO `airport_staff` (`name`, `password`) VALUES
('David Clark', 'staff123'),
('Daniel Lewis', 'staff123'),
('Rachel Adams', 'staff123')
ON DUPLICATE KEY UPDATE `name`=VALUES(`name`);

-- Flights
INSERT INTO `flight` (`flight_no`, `source`, `destination`, `departure_time`, `arrival_time`, `total_seats`, `available_seats`, `status`) VALUES
('AS-101', 'Dubai', 'London', '08:00:00', '12:30:00', 250, 248, 'On Time'),
('AS-202', 'New York', 'Paris', '14:15:00', '22:45:00', 180, 179, 'On Time'),
('AS-303', 'Tokyo', 'Sydney', '06:30:00', '18:00:00', 200, 199, 'Delayed'),
('AS-404', 'Singapore', 'Frankfurt', '23:00:00', '05:30:00', 300, 300, 'On Time'),
('AS-505', 'Los Angeles', 'Tokyo', '11:00:00', '16:30:00', 220, 219, 'Reached Destination'),
('AS-606', 'Mumbai', 'Dubai', '09:45:00', '11:30:00', 190, 190, 'Cancelled')
ON DUPLICATE KEY UPDATE `status`=VALUES(`status`);

-- Bookings
INSERT INTO `booking` (`passenger_id`, `flight_id`, `booking_code`, `seat_no`) VALUES
(1, 1, 'BK-78901', '12A'),
(1, 2, 'BK-45210', '04B'),
(2, 1, 'BK-99381', '12B'),
(3, 3, 'BK-11029', '22F'),
(4, 5, 'BK-33910', '01A')
ON DUPLICATE KEY UPDATE `booking_code`=VALUES(`booking_code`);

-- Staff Schedules
INSERT INTO `staff_schedule` (`flight_id`, `pilot_id`, `hostess_id`, `staff_id`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2)
ON DUPLICATE KEY UPDATE `pilot_id`=VALUES(`pilot_id`);
