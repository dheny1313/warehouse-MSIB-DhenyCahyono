<?php
class Werehouse
{
    private $conn;
    private $table_name = "gudang";

    public $id;
    public $name;
    public $location;
    public $capacity;
    public $status;
    public $opening_hour;
    public $closing_hour;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function read()
    {
        // $query = "SELECT * FROM ". $this->table_name;
        // $stmt = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare("SELECT id, name, location, capacity, status, opening_hour, closing_hour from " . $this->table_name);
        $stmt->execute();

        return $stmt;
    }

    public function create()
    {
        $stmt = $this->conn->prepare("insert into " . $this->table_name . "(name,location, capacity, status,opening_hour, closing_hour) VALUES (:name, :location, :capacity, :status, :opening_hour,:closing_hour)");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);

        // var_dump($this->name);
        // var_dump($this->location);
        // var_dump($this->capacity);
        // var_dump($this->status);
        // var_dump($this->opening_hour);
        // var_dump($this->closing_hour);
        // exit;
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function show($id)
    {
        $stmt = $this->conn->prepare("SELECT * From " . $this->table_name . " where id=:id ");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt;
    }

    public function update()
    {
        // var_dump($this->name);
        // var_dump($this->location);
        // var_dump($this->capacity);
        // var_dump($this->status);
        // var_dump($this->opening_hour);
        // var_dump($this->closing_hour);
        // exit;
        $stmt = $this->conn->prepare("UPDATE " . $this->table_name . " SET name=:name,location=:location,capacity=:capacity,status=:status,opening_hour=:opening_hour,closing_hour=:closing_hour Where id=:id ");
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":location", $this->location);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":opening_hour", $this->opening_hour);
        $stmt->bindParam(":closing_hour", $this->closing_hour);
        // jangan lupa perlu id
        $stmt->bindParam(":id", $this->id);

        try {
            if ($stmt->execute()) {
                return true;
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }




    public function delete()
    {
        $stmt = $this->conn->prepare("DELETE FROM " . $this->table_name . " WHERE id=:id");
        $stmt->bindParam(":id", $this->id);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
