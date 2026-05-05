<?php

class BookController {

    public function index() {
        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';
        $database = new Database();
        $db = $database->getConnection();
        $bookModel = new Book($db);
        $books = $bookModel->getAll();
        require_once '../app/views/books/book_list.php';
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro přidání knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        // ZMĚNA: Načtení databáze a nového modelu Category
        require_once '../app/models/Database.php';
        require_once '../app/models/Category.php';
        require_once '../app/models/Subcategory.php';

        $database = new Database();
        $db = $database->getConnection();

        // ZMĚNA: Získání seznamu kategorií
        $categoryModel = new Category($db);
        $categories = $categoryModel->getAllCategories();
        
        $subcategoryModel = new Subcategory($db); // PŘIDÁNO
        $subcategories = $subcategoryModel->getAllSubcategories();


        require_once '../app/views/books/book_create.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $this->addErrorMessage('Pro uložení knihy musíte být přihlášeni.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }
            
            $userId = $_SESSION['user_id'];
            $title = htmlspecialchars($_POST['title'] ?? '');
            $author = htmlspecialchars($_POST['author'] ?? '');
            $isbn = htmlspecialchars($_POST['isbn'] ?? '');
            $category = (int)($_POST['category'] ?? 0);
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? '');
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            $link = htmlspecialchars($_POST['link'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');

            $uploadedImages = $this->processImageUploads();

            require_once '../app/models/Database.php';
            require_once '../app/models/Book.php';
            $database = new Database();
            $db = $database->getConnection();
            $bookModel = new Book($db);

            $isSaved = $bookModel->create(
                $title, $author, $category, $subcategory, 
                $year, $price, $isbn, $description, $link, $uploadedImages,
                $userId
            );

            if ($isSaved) {
                $this->addSuccessMessage('Kniha byla úspěšně uložena do databáze.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nastala chyba. Nepodařilo se uložit knihu.');
            }
        }
    }

    public function edit($id = null) {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro úpravu knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }
        
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy k úpravě.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';
        require_once '../app/models/Category.php';
        require_once '../app/models/Subcategory.php';

        $database = new Database();
        $db = $database->getConnection();

        // ZMĚNA: Získání seznamu kategorií
        $categoryModel = new Category($db);
        $categories = $categoryModel->getAllCategories();
        
        $subcategoryModel = new Subcategory($db); // PŘIDÁNO
        $subcategories = $subcategoryModel->getAllSubcategories();

        $bookModel = new Book($db);
        $book = $bookModel->getById($id);

        if (!$book || $book['created_by'] !== $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění upravovat tuto knihu.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once '../app/views/books/book_edit.php';
    }

    public function update($id = null) {
        if (!$id) {
            $this->addErrorMessage('Nebylo zadáno ID knihy k aktualizaci.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user_id'])) {
                $this->addErrorMessage('Pro uložení změn se musíte nejprve přihlásit.');
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
                exit;
            }

            require_once '../app/models/Database.php';
            require_once '../app/models/Book.php';

            $database = new Database();
            $db = $database->getConnection();
            $bookModel = new Book($db);
            $book = $bookModel->getById($id);

            if (!$book || $book['created_by'] !== $_SESSION['user_id']) {
                $this->addErrorMessage('Nemáte oprávnění ukládat změny u této knihy.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }

            // Sběr a očištění dat
            $title = htmlspecialchars($_POST['title'] ?? '');
            $author = htmlspecialchars($_POST['author'] ?? '');
            $isbn = htmlspecialchars($_POST['isbn'] ?? '');
            //$category = htmlspecialchars($_POST['category'] ?? '');
            $category = (int)($_POST['category'] ?? 0);
            $subcategory = htmlspecialchars($_POST['subcategory'] ?? '');
            $year = (int)($_POST['year'] ?? 0);
            $price = (float)($_POST['price'] ?? 0);
            $link = htmlspecialchars($_POST['link'] ?? '');
            $description = htmlspecialchars($_POST['description'] ?? '');
            $uploadedImages = $this->processImageUploads();

            // --- IMPLEMENTACE UPDATED_BY ---
            $userId = $_SESSION['user_id'];

            $isUpdated = $bookModel->update(
                $id, $title, $author, $category, $subcategory, 
                $year, $price, $isbn, $description, $link, $uploadedImages,
                $userId // Poslední argument pro model
            );

            if ($isUpdated) {
                $this->addSuccessMessage('Kniha byla úspěšně upravena.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nastala chyba při ukládání změn.');
            }
        }
    }

    public function detail($id = null) {
    if (!$id) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    require_once '../app/models/Database.php';
    require_once '../app/models/Book.php';
    require_once '../app/models/Comment.php';

    $db = (new Database())->getConnection();
    $bookModel = new Book($db);
    
    // Získání dat o knize
    $book = $bookModel->getById($id);

    // Pokud model nic nevrátil, vypiš si proč (dočasně pro ladění)
    if (!$book) {
        // die("Kniha s ID $id nebyla v databázi nalezena!"); // Pokud tohle uvidíš, ID v DB neexistuje
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // Načtení komentářů
    $commentModel = new Comment($db);
    $comments = $commentModel->getByBookId($id);

    // Načtení pohledu (view)
    require_once '../app/views/books/book_detail.php';
}   

    public function addComment() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
        require_once '../app/models/Database.php';
        require_once '../app/models/Comment.php';
        require_once '../app/models/Book.php';

        $database = new Database();
        $db = $database->getConnection();
        
        // Důležité: získání ID knihy z POSTu
        $bookId = isset($_POST['book_id']) ? (int)$_POST['book_id'] : 0;
        $content = trim(htmlspecialchars($_POST['content'] ?? ''));
        $userId = $_SESSION['user_id'];

        if ($bookId <= 0) {
            $this->addErrorMessage('Neplatné ID knihy.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $bookModel = new Book($db);
        $book = $bookModel->getById($bookId);

        // Kontrola, zda kniha existuje a patří uživateli
        if ($book && $book['created_by'] == $userId) {
            if (!empty($content)) {
                $commentModel = new Comment($db);
                $commentModel->create($bookId, $userId, $content);
                $this->addSuccessMessage('Poznámka uložena.');
            } else {
                $this->addErrorMessage('Obsah poznámky nesmí být prázdný.');
            }
        } else {
            $this->addErrorMessage('Oprávnění zamítnuto.');
        }
        
        // Přesměrování zpět na detail konkrétní knihy
        header('Location: ' . BASE_URL . '/index.php?url=book/detail/' . $bookId);
        exit;
    }
}


    public function delete($id = null) {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro smazání knihy se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Book.php';
        $database = new Database();
        $db = $database->getConnection();
        $bookModel = new Book($db);
        $book = $bookModel->getById($id);

        if (!$book || $book['created_by'] !== $_SESSION['user_id']) {
            $this->addErrorMessage('Nemáte oprávnění smazat tuto knihu.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        if ($bookModel->delete($id)) {
            $this->addSuccessMessage('Kniha byla trvale smazána.');
        } else {
            $this->addErrorMessage('Knihu se nepodařilo smazat.');
        }
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    protected function addSuccessMessage($message) { $_SESSION['messages']['success'][] = $message; }
    protected function addNoticeMessage($message) { $_SESSION['messages']['notice'][] = $message; }
    protected function addErrorMessage($message) { $_SESSION['messages']['error'][] = $message; }

    protected function processImageUploads() {
        $uploadedFiles = [];
        $uploadDir = __DIR__ . '/../../public/uploads/'; 
        if (!is_dir($uploadDir)) { mkdir($uploadDir, 0777, true); }

        if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
            $fileCount = count($_FILES['images']['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                if ($_FILES['images']['error'][$i] === UPLOAD_ERR_OK) {
                    $fileExtension = strtolower(pathinfo($_FILES['images']['name'][$i], PATHINFO_EXTENSION));
                    if (in_array($fileExtension, ['jpg', 'jpeg', 'png', 'webp', 'gif'])) {
                        $newName = 'book_' . uniqid() . '_' . substr(md5(mt_rand()), 0, 4) . '.' . $fileExtension;
                        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $uploadDir . $newName)) {
                            $uploadedFiles[] = $newName; 
                        }
                    }
                }
            }
        }
        return $uploadedFiles;
    }
}