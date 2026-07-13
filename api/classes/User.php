<?php
abstract class User {
    protected $conn;
    protected $table_name;
    protected $id_field;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function login($identifier, $password) {
        $identifier = mysqli_real_escape_string($this->conn, $identifier);
        $password = mysqli_real_escape_string($this->conn, $password);

        // For passenger table, query by email. For others, query by name or username.
        $login_field = ($this->table_name === 'passenger') ? 'email' : (($this->table_name === 'admin') ? 'username' : 'name');
        
        $query = "SELECT * FROM {$this->table_name} WHERE {$login_field}='$identifier' AND password='$password'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            return mysqli_fetch_assoc($result);
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name}";
        return mysqli_query($this->conn, $query);
    }
}
?>
