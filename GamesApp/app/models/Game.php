<?php

class Game {
    private $conn;
    private $table_name = "games";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Načtení všech her z databáze
    public function getAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Načtení jedné konkrétní hry podle ID
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Vytvoření nového záznamu hry (Store)
    public function create($data) {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET title = :title, 
                      developer = :developer, 
                      category_id = :category_id, 
                      year = :year, 
                      price = :price, 
                      description = :description, 
                      images = :images, 
                      created_by = :created_by";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':developer', $data['developer']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':images', $data['images']);
        $stmt->bindParam(':created_by', $data['created_by']);

        return $stmt->execute();
    }

    /* =========================================================================
       KOMPLETNĚ OPRAVENÁ METODA UPDATE (Přijímá ID a pole $data)
       ========================================================================= */
    public function update($id, $data) {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title, 
                      developer = :developer, 
                      category_id = :category_id, 
                      year = :year, 
                      price = :price, 
                      description = :description, 
                      images = :images,
                      updated_by = :updated_by
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        // Nabindování dat z pole předaného z GameControlleru
        $stmt->bindParam(':title', $data['title']);
        $stmt->bindParam(':developer', $data['developer']);
        $stmt->bindParam(':category_id', $data['category_id']);
        $stmt->bindParam(':year', $data['year']);
        $stmt->bindParam(':price', $data['price']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':images', $data['images']);
        $stmt->bindParam(':updated_by', $data['updated_by']); // Logování editora pro phpMyAdmin
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    // Smazání hry z databáze
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}