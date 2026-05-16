<?php

class Book {
    private PDO $db;

    public function __construct(PDO $db) {
        $this->db = $db;    
    }

    public function create(
        string $title, 
        string $author, 
        int $category, 
        string $subcategory,
        int $year, 
        float $price, 
        string $isbn, 
        string $description,
        string $link, 
        array $images, 
        int $userId
    ): bool {
        $sql = "INSERT INTO books (title, author, category, subcategory, year, price, isbn, description, link, images, created_by)
                VALUES (:title, :author, :category, :subcategory, :year, :price, :isbn, :description, :link, :images, :created_by)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory ?: null,
            ':year' => $year,
            ':price' => $price,
            ':isbn' => $isbn,
            ':description' => $description,
            ':link' => $link,
            ':images' => json_encode($images),
            ':created_by' => $userId
        ]);
    }

    /*public function getAll() {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }*/

    // Získání všech knih z databáze (Nyní včetně názvu kategorie)
    public function getAll() {
        
        // 💡 ZMĚNA: Místo "SELECT *" použijeme přesnější dotaz s JOINem
        $sql = "SELECT books.*, categories.name AS category_name 
                FROM books 
                LEFT JOIN categories ON books.category = categories.id 
                ORDER BY books.id DESC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // OPRAVENÁ METODA S JOINEM (Pro detail s kategoriemi)
    public function getById($id) {
        $query = "SELECT b.*, 
                         c.name AS category_name, 
                         s.name AS subcategory_name 
                  FROM books b
                  LEFT JOIN categories c ON b.category = c.id 
                  LEFT JOIN subcategories s ON b.subcategory = s.id 
                  WHERE b.id = ?";
        
        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(
        $id, 
        $title, 
        $author, 
        $category, 
        $subcategory, 
        $year, 
        $price, 
        $isbn, 
        $description, 
        $link, 
        $images, 
        $updatedBy
    ) {
        $sql = "UPDATE books 
                SET title = :title, 
                    author = :author, 
                    category = :category, 
                    subcategory = :subcategory, 
                    year = :year, 
                    price = :price, 
                    isbn = :isbn, 
                    description = :description, 
                    link = :link, 
                    images = :images,
                    updated_by = :updated_by
                WHERE id = :id";
                
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':title' => $title,
            ':author' => $author,
            ':category' => $category,
            ':subcategory' => $subcategory ?: null,
            ':year' => $year,
            ':price' => $price,
            ':isbn' => $isbn,
            ':description' => $description,
            ':link' => $link,
            ':images' => json_encode($images),
            ':updated_by' => $updatedBy
        ]);
    }

    public function delete($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}