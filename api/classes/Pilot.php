<?php
class Pilot extends User {
    private $pilot_id;

    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'pilot';
        $this->id_field = 'pilot_id';
    }

    public function getPilotId() { return $this->pilot_id; }

    public function add($name, $password) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $password = mysqli_real_escape_string($this->conn, $password);

        $query = "INSERT INTO pilot (name, password) VALUES ('$name', '$password')";
        return mysqli_query($this->conn, $query);
    }
}
?>
