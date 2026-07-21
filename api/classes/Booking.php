<?php
class Booking {
    private $conn;
    private $booking_id;
    private $passenger_id;
    private $flight_id;
    private $booking_code;
    private $seat_no;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getBookingId() { return $this->booking_id; }
    public function getPassengerId() { return $this->passenger_id; }
    public function getFlightId() { return $this->flight_id; }
    public function getBookingCode() { return $this->booking_code; }
    public function getSeatNo() { return $this->seat_no; }

    public function getByPassenger($passenger_id) {
        $passenger_id = mysqli_real_escape_string($this->conn, $passenger_id);
        return mysqli_query($this->conn, "
            SELECT booking.*, flight.* 
            FROM booking
            JOIN flight ON booking.flight_id = flight.flight_id
            WHERE booking.passenger_id='$passenger_id'
            ORDER BY booking.booking_id DESC
        ");
    }

    public function getDetails($booking_id, $passenger_id) {
        $booking_id = mysqli_real_escape_string($this->conn, $booking_id);
        $passenger_id = mysqli_real_escape_string($this->conn, $passenger_id);
        
        $result = mysqli_query($this->conn, "
            SELECT booking.*, flight.*, passenger.name AS passenger_name
            FROM booking
            JOIN flight ON booking.flight_id = flight.flight_id
            JOIN passenger ON booking.passenger_id = passenger.passenger_id
            WHERE booking.booking_id='$booking_id'
            AND booking.passenger_id='$passenger_id'
        ");
        $data = mysqli_fetch_assoc($result);
        if ($data) {
            $this->booking_id = $data['booking_id'];
            $this->passenger_id = $data['passenger_id'];
            $this->flight_id = $data['flight_id'];
            $this->booking_code = $data['booking_code'];
            $this->seat_no = $data['seat_no'];
        }
        return $data;
    }

    public function book($passenger_id, $flight_id, $booking_code, $seat_no) {
        $passenger_id = mysqli_real_escape_string($this->conn, $passenger_id);
        $flight_id = mysqli_real_escape_string($this->conn, $flight_id);
        $booking_code = mysqli_real_escape_string($this->conn, $booking_code);
        $seat_no = mysqli_real_escape_string($this->conn, $seat_no);

        return mysqli_query($this->conn, "
            INSERT INTO booking (passenger_id, flight_id, booking_code, seat_no)
            VALUES ('$passenger_id', '$flight_id', '$booking_code', '$seat_no')
        ");
    }

    public function cancel($booking_id, $passenger_id) {
        $booking_id = mysqli_real_escape_string($this->conn, $booking_id);
        $passenger_id = mysqli_real_escape_string($this->conn, $passenger_id);

        return mysqli_query($this->conn, "
            DELETE FROM booking 
            WHERE booking_id='$booking_id' 
            AND passenger_id='$passenger_id'
        ");
    }
}
?>
