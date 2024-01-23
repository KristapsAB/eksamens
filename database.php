<?php
// database.php
class Database {
    public $connection; // Change visibility to public

    private $host = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "entries";

    public function __construct() {
        $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);

        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function query($sql) {
        return $this->connection->query($sql);
    }

    public function closeConnection() {
        $this->connection->close();
    }
}
?>
