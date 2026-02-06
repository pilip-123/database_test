<?php
require_once __DIR__ . '/../config/database.php';

class Promotion {
    private $conn;
    private $table = "promotions";

    public $id;
    public $title;
    public $discount_percent;  // Changed from discount_percentage
    public $start_date;
    public $end_date;
    public $status;
    public $created_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  SET title=:title, discount_percent=:discount_percent, 
                      start_date=:start_date, end_date=:end_date, status=:status";
        
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->discount_percent = htmlspecialchars(strip_tags($this->discount_percent));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->status = htmlspecialchars(strip_tags($this->status));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":discount_percent", $this->discount_percent);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":status", $this->status);

        return $stmt->execute();
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->title = $row['title'];
            $this->discount_percent = $row['discount_percent'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
            $this->status = $row['status'];
        }
    }

    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET title=:title, discount_percent=:discount_percent, 
                      start_date=:start_date, end_date=:end_date, status=:status
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->discount_percent = htmlspecialchars(strip_tags($this->discount_percent));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":discount_percent", $this->discount_percent);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }

    // Remove getProducts() method since promotions are not linked to products
}
?>