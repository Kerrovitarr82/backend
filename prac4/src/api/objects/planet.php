<?php

class Planet
{
    private $conn;
    private $table_name = "planets";

    public $id;
    public $name;
    public $description;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        $query = "SELECT id, name, description FROM " . $this->table_name;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();
        return $stmt;
    }

    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function readOne()
    {
        $query = "SELECT id, name, description FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row["name"];
        $this->description = $row["description"];
    }

    function update()
    {

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));

        if (!empty($this->name) && !empty($this->description)) {
            $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description WHERE id = :id";
        } elseif (!empty($this->description)) {
            $query = "UPDATE " . $this->table_name . " SET name = name, description = :description WHERE id = :id";
        } else {
            $query = "UPDATE " . $this->table_name . " SET name = :name, description = description WHERE id = :id";
        }

        $stmt = $this->conn->prepare($query);
        if (!empty($this->name)) {
            $stmt->bindParam(":name", $this->name);
        }
        if (!empty($this->description)) {
            $stmt->bindParam(":description", $this->description);
        }
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    function delete()
    {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}