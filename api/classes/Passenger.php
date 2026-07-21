<?php
class Passenger extends User {
    private $passenger_id;
    private $email;

    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'passenger';
        $this->id_field = 'passenger_id';
    }

    public function getPassengerId() { return $this->passenger_id; }
    public function getEmail() { return $this->email; }

    public function register($name, $email, $password) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $email = mysqli_real_escape_string($this->conn, $email);
        $password = mysqli_real_escape_string($this->conn, $password);

        $query = "INSERT INTO passenger (name, email, password) VALUES ('$name', '$email', '$password')";
        return mysqli_query($this->conn, $query);
    }
}
?>
