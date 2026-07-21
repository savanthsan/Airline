<?php
class AirportStaff extends User {
    private $staff_id;

    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'airport_staff';
        $this->id_field = 'staff_id';
    }

    public function getStaffId() { return $this->staff_id; }

    public function add($name, $password) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $password = mysqli_real_escape_string($this->conn, $password);

        $query = "INSERT INTO airport_staff (name, password) VALUES ('$name', '$password')";
        return mysqli_query($this->conn, $query);
    }
}
?>
