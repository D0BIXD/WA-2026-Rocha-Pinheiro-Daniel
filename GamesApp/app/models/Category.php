<?php

class Category {
    private $conn;
    private $table_name = "categories";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Načtení všech kategorií seřazených podle názvu
    public function getAll() {
        $query = "SELECT id, name FROM " . $this->table_name . " ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}