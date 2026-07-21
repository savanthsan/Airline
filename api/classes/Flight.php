<?php
class Flight {
    private $conn;
    private $flight_id;
    private $flight_no;
    private $source;
    private $destination;
    private $departure_time;
    private $arrival_time;
    private $total_seats;
    private $available_seats;
    private $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getFlightId() { return $this->flight_id; }
    public function getFlightNo() { return $this->flight_no; }
    public function getSource() { return $this->source; }
    public function getDestination() { return $this->destination; }
    public function getDepartureTime() { return $this->departure_time; }
    public function getArrivalTime() { return $this->arrival_time; }
    public function getTotalSeats() { return $this->total_seats; }
    public function getAvailableSeats() { return $this->available_seats; }
    public function getStatus() { return $this->status; }

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
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            $this->flight_id = $data['flight_id'];
            $this->flight_no = $data['flight_no'];
            $this->source = $data['source'];
            $this->destination = $data['destination'];
            $this->departure_time = $data['departure_time'];
            $this->arrival_time = $data['arrival_time'];
            $this->total_seats = $data['total_seats'];
            $this->available_seats = $data['available_seats'];
            $this->status = $data['status'];
        }
        return $data;
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
