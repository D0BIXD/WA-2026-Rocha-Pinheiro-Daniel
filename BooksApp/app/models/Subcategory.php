<?php

class Subcategory {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllSubcategories() {
        // Opraveno na $this->db, což odpovídá tvému konstruktoru
        $query = "SELECT * FROM subcategories ORDER BY name ASC";
        $stmt = $this->db->prepare($query); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}