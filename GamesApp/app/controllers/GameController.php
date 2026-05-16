<?php

class GameController {

    // Pomocná metoda pro přidání úspěšné zprávy do session
    private function addSuccessMessage($msg) {
        $_SESSION['messages']['success'][] = $msg;
    }

    // Pomocná metoda pro přidání chybové zprávy do session
    private function addErrorMessage($msg) {
        $_SESSION['messages']['error'][] = $msg;
    }

    // Zobrazení seznamu všech her
    public function index() {
        require_once '../app/models/Database.php';
        require_once '../app/models/Game.php';

        $database = new Database();
        $db = $database->getConnection();
        $gameModel = new Game($db);

        $games = $gameModel->getAll();

        require_once '../app/views/games/GameList.php';
    }

    // Zobrazení detailu konkrétní hry
    public function show($id) {
        require_once '../app/models/Database.php';
        require_once '../app/models/Game.php';
        require_once '../app/models/Comment.php';

        $database = new Database();
        $db = $database->getConnection();
        
        $gameModel = new Game($db);
        $game = $gameModel->getById($id);

        $commentModel = new Comment($db);
        $comments = $commentModel->getByGameId($id);

        require_once '../app/views/games/GameDetails.php';
    }

    // Zobrazení formuláře pro přidání nové hry
    public function create() {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro přístup do Vaultu se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Category.php';

        $database = new Database();
        $db = $database->getConnection();
        $categoryModel = new Category($db);
        $categories = $categoryModel->getAll(); // Volá metodu z Category.php

        require_once '../app/views/games/GameCreate.php';
    }

    // Uložení nové hry do databáze
    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/models/Database.php';
            require_once '../app/models/Game.php';

            $database = new Database();
            $db = $database->getConnection();
            $gameModel = new Game($db);

            $uploadedImages = [];
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $fileName = $_FILES['images']['name'][$key];
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newName = 'game_' . uniqid() . '_' . bin2hex(random_bytes(2)) . '.' . $ext;
                    $targetPath = $uploadDir . $newName;

                    if (move_uploaded_file($tmpName, $targetPath)) {
                        $uploadedImages[] = $newName;
                    }
                }
            }

            $data = [
                'title' => htmlspecialchars($_POST['title'] ?? ''),
                'developer' => htmlspecialchars($_POST['developer'] ?? ''),
                'category_id' => intval($_POST['category_id'] ?? 0),
                'year' => intval($_POST['year'] ?? 0),
                'price' => floatval($_POST['price'] ?? 0),
                'description' => htmlspecialchars($_POST['description'] ?? ''),
                'images' => json_encode($uploadedImages),
                'created_by' => $_SESSION['user_id']
            ];

            if ($gameModel->create($data)) {
                $this->addSuccessMessage('Hra byla úspěšně uložena do Vaultu.');
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            } else {
                $this->addErrorMessage('Nepodařilo se uložit hru do systému.');
            }
        }
    }

    // Zobrazení formuláře pro úpravu hry
    public function edit($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Game.php';
        require_once '../app/models/Category.php';

        $database = new Database();
        $db = $database->getConnection();
        
        $gameModel = new Game($db);
        $game = $gameModel->getById($id);

        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
        if (!$game || ($game['created_by'] !== $_SESSION['user_id'] && !$isAdmin)) {
            $this->addErrorMessage('Nemáte oprávnění upravovat tento herní titul.');
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $categoryModel = new Category($db);
        $categories = $categoryModel->getAll(); // Tady to házelo chybu, nyní opraveno!

        require_once '../app/views/games/GameEdit.php';
    }

    // Aktualizace hry v databázi
    public function update($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/models/Database.php';
            require_once '../app/models/Game.php';

            $database = new Database();
            $db = $database->getConnection();
            $gameModel = new Game($db);

            $game = $gameModel->getById($id);
            $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
            if (!$game || ($game['created_by'] !== $_SESSION['user_id'] && !$isAdmin)) {
                header('Location: ' . BASE_URL . '/index.php');
                exit;
            }

            $uploadedImages = json_decode($game['images'] ?? '[]', true);
            if (!empty($_FILES['images']['name'][0])) {
                $uploadDir = '../public/uploads/';
                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $fileName = $_FILES['images']['name'][$key];
                    $ext = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newName = 'game_' . uniqid() . '_' . bin2hex(random_bytes(2)) . '.' . $ext;
                    if (move_uploaded_file($tmpName, $uploadDir . $newName)) {
                        $uploadedImages = [$newName];
                    }
                }
            }

            $data = [
                'title' => htmlspecialchars($_POST['title'] ?? ''),
                'developer' => htmlspecialchars($_POST['developer'] ?? ''),
                'category_id' => intval($_POST['category_id'] ?? 0),
                'year' => intval($_POST['year'] ?? 0),
                'price' => floatval($_POST['price'] ?? 0),
                'description' => htmlspecialchars($_POST['description'] ?? ''),
                'images' => json_encode($uploadedImages)
            ];

            if ($gameModel->update($id, $data)) {
                $this->addSuccessMessage('Záznam hry byl úspěšně aktualizován.');
                header('Location: ' . BASE_URL . '/index.php?url=game/show/' . $id);
                exit;
            } else {
                $this->addErrorMessage('Při ukládání změn nastala chyba.');
            }
        }
    }

    // Odstranění hry z databáze
    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/models/Database.php';
        require_once '../app/models/Game.php';

        $database = new Database();
        $db = $database->getConnection();
        $gameModel = new Game($db);

        $game = $gameModel->getById($id);
        $isAdmin = isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1;
        if ($game && ($game['created_by'] === $_SESSION['user_id'] || $isAdmin)) {
            if ($gameModel->delete($id)) {
                $this->addSuccessMessage('Hra byla kompletně vymazána z Vaultu.');
            } else {
                $this->addErrorMessage('Hru se nepodařilo smazat.');
            }
        }

        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }

    // Uložení poznámky k hře
    public function addComment($gameId) {
        if (!isset($_SESSION['user_id'])) {
            $this->addErrorMessage('Pro přidání poznámky se musíte nejprve přihlásit.');
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            require_once '../app/models/Database.php';
            require_once '../app/models/Comment.php';

            $database = new Database();
            $db = $database->getConnection();
            $commentModel = new Comment($db);

            $content = htmlspecialchars($_POST['content'] ?? '');

            if (!empty($content)) {
                $result = $commentModel->create($gameId, $_SESSION['user_id'], $content);

                if ($result) {
                    $this->addSuccessMessage('Záznam byl úspěšně zapsán do herního logu.');
                } else {
                    $this->addErrorMessage('Chyba: Nepodařilo se zapsat poznámku.');
                }
            } else {
                $this->addErrorMessage('Obsah poznámky nesmí být prázdný.');
            }
        }

        header('Location: ' . BASE_URL . '/index.php?url=game/show/' . intval($gameId));
        exit;
    }
}