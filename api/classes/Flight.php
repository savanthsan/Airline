<?php
class Flight {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        return mysqli_query($this->conn, "SELECT * FROM flight");
    }

    public function search($source, $destination) {
        $source = mysqli_real_escape_string($this->conn, $source);
        $destination = mysqli_real_escape_string($this->conn, $destination);
        return mysqli_query($this->conn, "SELECT * FROM flight WHERE source='$source' AND destination='$destination'");
    }

    public function getById($flight_id) {
        $flight_id = mysqli_real_escape_string($this->conn, $flight_id);
        $result = mysqli_query($this->conn, "SELECT * FROM flight WHERE flight_id='$flight_id'");
        return mysqli_fetch_assoc($result);
    }

    public function add($flight_no, $source, $destination, $departure_time, $arrival_time, $total_seats) {
        $flight_no = mysqli_real_escape_string($this->conn, $flight_no);
        $source = mysqli_real_escape_string($this->conn, $source);
        $destination = mysqli_real_escape_string($this->conn, $destination);
        $departure_time = mysqli_real_escape_string($this->conn, $departure_time);
        $arrival_time = mysqli_real_escape_string($this->conn, $arrival_time);
        $total_seats = (int)$total_seats;

        $query = "INSERT INTO flight (flight_no, source, destination, departure_time, arrival_time, total_seats, available_seats) 
                  VALUES ('$flight_no', '$source', '$destination', '$departure_time', '$arrival_time', '$total_seats', '$total_seats')";
        return mysqli_query($this->conn, $query);
    }

    public function updateStatus($flight_id, $status) {
        $flight_id = mysqli_real_escape_string($this->conn, $flight_id);
        $status = mysqli_real_escape_string($this->conn, $status);
        return mysqli_query($this->conn, "UPDATE flight SET status='$status' WHERE flight_id='$flight_id'");
    }

    public function updateSeats($flight_id, $change) {
        $flight_id = mysqli_real_escape_string($this->conn, $flight_id);
        $change = (int)$change;
        return mysqli_query($this->conn, "UPDATE flight SET available_seats = available_seats + ($change) WHERE flight_id='$flight_id'");
    }
}
?>
