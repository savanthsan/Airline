<?php
class Hostess extends User {
    private $hostess_id;

    public function __construct($db) {
        parent::__construct($db);
        $this->table_name = 'hostess';
        $this->id_field = 'hostess_id';
    }

    public function getHostessId() { return $this->hostess_id; }

    public function add($name, $password) {
        $name = mysqli_real_escape_string($this->conn, $name);
        $password = mysqli_real_escape_string($this->conn, $password);

        $query = "INSERT INTO hostess (name, password) VALUES ('$name', '$password')";
        return mysqli_query($this->conn, $query);
    }
}
?>
