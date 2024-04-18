<?php
include_once "../config/database.php";

class Comment {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readApproved() {
        $query = "SELECT * FROM comments WHERE is_approved = 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    }

    public function readAllUnapproved() {
        $query = "SELECT * FROM comments WHERE is_approved = 0";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    public function approve($id) {
        $query = "UPDATE comments SET is_approved = 1 WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
    
   
    public function create($user_name, $email, $comment) {
        $query = "INSERT INTO comments (user_name, email, comment, is_approved) VALUES (?, ?, ?, 0)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sss', $user_name, $email, $comment);
        if($stmt->execute()){
            return true;
        }
        return false;
    }

}
?>
