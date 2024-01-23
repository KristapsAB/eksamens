<?php
// guestbook.php
require_once 'database.php';

class Guestbook extends Database {
    public function addEntry($name, $email, $message) {
        $name = $this->connection->real_escape_string($name);
        $email = $this->connection->real_escape_string($email);
        $message = $this->connection->real_escape_string($message);

        $sql = "INSERT INTO entries (name, email, message, created_at) VALUES ('$name', '$email', '$message', NOW())";
        $this->query($sql);
    }

    public function getEntries($sortColumn = 'created_at', $sortOrder = 'DESC') {
        $allowedColumns = ['name', 'email', 'created_at'];
        $sortColumn = in_array($sortColumn, $allowedColumns) ? $sortColumn : 'created_at';
        $sortOrder = ($sortOrder == 'ASC' || $sortOrder == 'DESC') ? $sortOrder : 'DESC';

        $sql = "SELECT * FROM entries ORDER BY $sortColumn $sortOrder";
        return $this->query($sql);
    }
    public function searchEntries($searchTerm) {
        $searchTerm = $this->connection->real_escape_string($searchTerm);

        $sql = "SELECT * FROM entries 
                WHERE name LIKE '%$searchTerm%' 
                OR email LIKE '%$searchTerm%' 
                OR message LIKE '%$searchTerm%'
                ORDER BY created_at DESC";

        $result = $this->query($sql);

        if (!$result) {
            die('Error: ' . $this->connection->error);
        }

        return $result;
    }
}
