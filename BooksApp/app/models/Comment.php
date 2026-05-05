<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Získání komentářů pro konkrétní knihu
    public function getByBookId($book_id) {
        $query = "SELECT * FROM comments WHERE book_id = ? ORDER BY created_at DESC";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$book_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Uložení nového komentáře
    public function create($book_id, $user_id, $content) {
        $query = "INSERT INTO comments (book_id, user_id, content) VALUES (?, ?, ?)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([$book_id, $user_id, $content]);
    }
}