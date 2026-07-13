<?php
class Database {
    private $host;
    private $user;
    private $pass;
    private $name;
    private $port;
    private $ssl_ca;
    private $conn;

    public function __construct() {
        $this->host = getenv('DB_HOST') ?: "localhost";
        $this->user = getenv('DB_USER') ?: "root";
        $this->pass = getenv('DB_PASSWORD') ?: "";
        $this->name = getenv('DB_NAME') ?: "airline_db";
        $this->port = getenv('DB_PORT') ?: "3306";
        $this->ssl_ca = getenv('DB_SSL_CA');
    }

    public function connect() {
        $this->conn = mysqli_init();
        if (!$this->conn) {
            die("mysqli_init failed");
        }

        if ($this->ssl_ca) {
            $this->conn->ssl_set(NULL, NULL, $this->ssl_ca, NULL, NULL);
            $this->conn->options(MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, true);
            $success = $this->conn->real_connect($this->host, $this->user, $this->pass, $this->name, $this->port, NULL, MYSQLI_CLIENT_SSL);
        } else {
            $success = $this->conn->real_connect($this->host, $this->user, $this->pass, $this->name, $this->port);
        }

        if (!$success) {
            die("Database connection failed: " . mysqli_connect_error());
        }

        return $this->conn;
    }
}
?>
