<?php
include_once "../config/database.php";

class Product
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function readAll()
    {
        $query = "SELECT * FROM products LIMIT 9";
        if ($stmt = $this->conn->prepare($query)) {
            $stmt->execute();
            $result = $stmt->get_result();
            return $result;
        } else {
            die('MySQL prepare error: ' . $this->conn->error);
        }
    }


}
?>