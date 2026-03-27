<?php

class BookController {
    // Zobrazení úvodní stránky se seznamem knih
    public function index() {
        // Připojení k databázi přímo v metodě
        require_once '../app/models/Database.php';
        $database = new Database();
        $db = $database->getConnection();

        // Načtení všech knih seřazených od nejnovější
        $sql = "SELECT * FROM books ORDER BY created_at DESC";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        // Uložení výsledků do proměnné pro view
        $books = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once '../app/views/books/book_list.php';
    }

    // Zobrazení formuláře pro přidání knihy
    public function create() {
        require_once '../app/views/books/book_create.php';
    }

    // Zpracování dat odeslaných z formuláře
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once '../app/models/Database.php';
            $database = new Database();
            $db = $database->getConnection();

            $sql = "INSERT INTO books (title, author, isbn, category, subcategory, year, price, link, description) 
                    VALUES (:title, :author, :isbn, :category, :subcategory, :year, :price, :link, :description)";
            
            $stmt = $db->prepare($sql);
            
            // Propojení dat z formuláře s SQL dotazem
            $stmt->execute([
                ':title' => $_POST['title'],
                ':author' => $_POST['author'],
                ':isbn' => $_POST['isbn'],
                ':category' => $_POST['category'],
                ':subcategory' => $_POST['subcategory'],
                ':year' => $_POST['year'],
                ':price' => $_POST['price'],
                ':link' => $_POST['link'],
                ':description' => $_POST['description']
            ]);

            // Přesměrování zpět na hlavní stránku
            header('Location: /WA-2026-Rocha-Pinheiro-Daniel/BooksApp/public/index.php');
            exit();
        }
    }
}