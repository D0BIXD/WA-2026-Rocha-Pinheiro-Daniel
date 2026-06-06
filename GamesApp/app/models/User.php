<?php

class User {
    private $db; // Budeme používat pouze tuto proměnnou

    // Konstruktor přijme databázové spojení a uloží ho do $this->db
    public function __construct($db) {
        $this->db = $db;
    }

    // Registrace nového uživatele
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

    // Vyhledání uživatele podle emailu
    public function findByEmail(string $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Aktualizace nastavení (zde používáme $this->db, aby to bylo jednotné)
    public function updateSettings($id, $nickname, $password = null) {
        if ($password && !empty($password)) {
            // Pokud je zadáno heslo, aktualizujeme přezdívku i heslo
            $query = "UPDATE users SET nickname = :nickname, password = :password WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute([
                ':nickname' => $nickname,
                ':password' => $hashedPassword,
                ':id'       => $id
            ]);
        } else {
            // Pokud heslo není, aktualizujeme pouze přezdívku
            $query = "UPDATE users SET nickname = :nickname WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->execute([
                ':nickname' => $nickname,
                ':id'       => $id
            ]);
        }
        
        return true;
    }
}