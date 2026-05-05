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

    public function getAll() {
        $sql = "SELECT * FROM books ORDER BY id DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $sql = "SELECT * FROM books WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // --- AKTUALIZOVANÁ METODA UPDATE ---
    // app/models/Book.php

// PŮVODNÍ (CHYBNÉ): ... $images = [], int $updatedBy)
// OPRAVENÉ: $updatedBy je nyní před $images

// Uprav řádek 53 v Book.php (Model)
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
    $images,    // 11. pozice: teď je tu pole s obrázky (odpovídá Array v chybě)
    $updatedBy  // 12. pozice: teď je tu ID uživatele (odpovídá číslu 1 v chybě)
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