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
        $envFile = __DIR__ . '/../../.env';
        if (file_exists($envFile)) {
            $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (strpos(trim($line), '#') === 0) continue;
                $parts = explode('=', $line, 2);
                if (count($parts) === 2 && getenv(trim($parts[0])) === false) {
                    putenv(trim($parts[0]) . '=' . trim($parts[1], " \t\n\r\0\x0B\"'"));
                }
            }
        }

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
        } elseif (getenv('DB_SSL') === 'true' || $this->port == '4000') {
            $this->conn->ssl_set(NULL, NULL, NULL, NULL, NULL);
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
