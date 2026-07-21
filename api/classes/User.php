<?php
abstract class User {
    protected $conn;
    protected $table_name;
    protected $id_field;

    protected $user_id;
    protected $name;
    protected $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getId() {
        return $this->user_id;
    }

    public function getName() {
        return $this->name;
    }

    public function login($identifier, $password) {
        $identifier = mysqli_real_escape_string($this->conn, $identifier);
        $password = mysqli_real_escape_string($this->conn, $password);

        $login_field = ($this->table_name === 'passenger') ? 'email' : (($this->table_name === 'admin') ? 'username' : 'name');
        
        $query = "SELECT * FROM {$this->table_name} WHERE {$login_field}='$identifier' AND password='$password'";
        $result = mysqli_query($this->conn, $query);
        
        if ($result && mysqli_num_rows($result) > 0) {
            $data = mysqli_fetch_assoc($result);
            $this->user_id = $data[$this->id_field] ?? null;
            $this->name = $data['name'] ?? ($data['username'] ?? '');
            return $data;
        }
        return false;
    }

    public function getAll() {
        $query = "SELECT * FROM {$this->table_name}";
        return mysqli_query($this->conn, $query);
    }
}
?>
