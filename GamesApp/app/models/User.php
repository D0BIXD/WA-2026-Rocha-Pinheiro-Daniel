<?php

class User {
    private PDO $db;

    public function __construct(PDO $db) {
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
}