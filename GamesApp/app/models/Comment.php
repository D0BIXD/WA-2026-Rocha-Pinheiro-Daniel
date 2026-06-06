<?php

class Comment {
    private $conn;
    private $table_name = "comments";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Vytvoření poznámky
    public function create($gameId, $userId, $content) {
        $query = "INSERT INTO " . $this->table_name . " (game_id, user_id, content) VALUES (:game_id, :user_id, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':game_id', $gameId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }
// Načtení všech poznámek pro hru VČETNĚ jména autora
    public function getByGameId($gameId) {
        // ZMĚNA: COALESCE vybere 'nickname', ale pokud je prázdný, vezme 'username'
        $query = "SELECT c.*, COALESCE(NULLIF(u.nickname, ''), u.username) as user_name 
                  FROM " . $this->table_name . " c
                  LEFT JOIN users u ON c.user_id = u.id
                  WHERE c.game_id = :game_id 
                  ORDER BY c.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':game_id', $gameId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Načtení jedné konkrétní poznámky
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Úprava poznámky
    public function update($id, $content) {
        $query = "UPDATE " . $this->table_name . " SET content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Smazání poznámky
    public function delete($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}