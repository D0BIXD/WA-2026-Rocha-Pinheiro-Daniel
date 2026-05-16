<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByGameId($game_id) {
        $query = "SELECT * FROM comments WHERE game_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$game_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($game_id, $user_id, $content) {
        $query = "INSERT INTO comments (game_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$game_id, $user_id, $content]);
    }
}