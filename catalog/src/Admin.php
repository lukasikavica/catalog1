<?php
class Admin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function authenticate($username, $password) {
        $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        if($stmt->get_result()->num_rows == 1) {
            return true;
        }
        return false;
    }

    public function approveComment($commentId) {
        $query = "UPDATE comments SET is_approved = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $commentId);
        $stmt->execute();
    }
}
?>