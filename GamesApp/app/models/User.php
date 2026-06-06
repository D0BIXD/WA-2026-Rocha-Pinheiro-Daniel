<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($username, $email, $password, $nickname = null) {
        if ($this->findByEmail($email)) {
            return false;
        }
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password, nickname) VALUES (:username, :email, :password, :nickname)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':password' => $hashedPassword,
            ':nickname' => $nickname
        ]);
    }

    public function findByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateSettings($id, $nickname, $password = null) {
        if ($password && !empty($password)) {
            $query = "UPDATE users SET nickname = :nickname, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([':nickname' => $nickname, ':password' => $hashedPassword, ':id' => $id]);
        } else {
            $query = "UPDATE users SET nickname = :nickname WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([':nickname' => $nickname, ':id' => $id]);
        }
        return true;
    }

   public function getGameCount($userId) {
        // Zde jsme změnili 'user_id' na 'created_by', aby to odpovídalo tvé databázi
        $sql = "SELECT COUNT(*) FROM games WHERE created_by = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return (int)$stmt->fetchColumn();
    }
    // Načtení dat jednoho uživatele podle jeho ID
    public function getUserById($id) {
        $sql = "SELECT * FROM users WHERE id = :id";    
        $stmt = $this->db->prepare($sql); 
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Metoda pro smazání uživatele z databáze (Delete)
    public function deleteUser($userId) {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql); 
        return $stmt->execute([':id' => $userId]);
    }
}