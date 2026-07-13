<?php
class Schedule {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAssignedFlights($type, $staff_id) {
        $staff_id = mysqli_real_escape_string($this->conn, $staff_id);
        $id_column = ($type === 'pilot') ? 'pilot_id' : (($type === 'hostess') ? 'hostess_id' : 'staff_id');
        
        return mysqli_query($this->conn, "
            SELECT flight.*
            FROM staff_schedule
            JOIN flight ON staff_schedule.flight_id = flight.flight_id
            WHERE staff_schedule.{$id_column} = '$staff_id'
        ");
    }

    public function assign($flight_id, $pilot_id, $hostess_id, $staff_id) {
        $flight_id = mysqli_real_escape_string($this->conn, $flight_id);
        $pilot_id = mysqli_real_escape_string($this->conn, $pilot_id);
        $hostess_id = mysqli_real_escape_string($this->conn, $hostess_id);
        $staff_id = mysqli_real_escape_string($this->conn, $staff_id);

        $check = mysqli_query($this->conn, "SELECT * FROM staff_schedule WHERE flight_id='$flight_id'");
        if (mysqli_num_rows($check) > 0) {
            $query = "UPDATE staff_schedule SET pilot_id='$pilot_id', hostess_id='$hostess_id', staff_id='$staff_id' WHERE flight_id='$flight_id'";
        } else {
            $query = "INSERT INTO staff_schedule (flight_id, pilot_id, hostess_id, staff_id) VALUES ('$flight_id', '$pilot_id', '$hostess_id', '$staff_id')";
        }
        return mysqli_query($this->conn, $query);
    }

    public function isAssigned($type, $staff_id) {
        $staff_id = mysqli_real_escape_string($this->conn, $staff_id);
        $id_column = ($type === 'pilot') ? 'pilot_id' : (($type === 'hostess') ? 'hostess_id' : 'staff_id');
        
        $check = mysqli_query($this->conn, "SELECT * FROM staff_schedule WHERE {$id_column}='$staff_id'");
        return mysqli_num_rows($check) > 0;
    }

    public function deleteStaffAssignment($type, $staff_id) {
        $staff_id = mysqli_real_escape_string($this->conn, $staff_id);
        $table = ($type === 'pilot') ? 'pilot' : (($type === 'hostess') ? 'hostess' : 'airport_staff');
        $id_column = ($type === 'pilot') ? 'pilot_id' : (($type === 'hostess') ? 'hostess_id' : 'staff_id');

        return mysqli_query($this->conn, "DELETE FROM {$table} WHERE {$id_column}='$staff_id'");
    }
}
?>
