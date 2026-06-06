<?php

class UserController {

    // Tvoje metoda pro načtení modelu a databáze
    private function getModel($modelName) {
        require_once '../app/models/Database.php';
        require_once '../app/models/' . $modelName . '.php';
        $database = new Database();
        return new $modelName($database->getConnection());
    }

    // Zobrazení stránky s nastavením
    public function settings() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            exit;
        }

        require_once '../app/views/user/settings.php';
    }

    // Zpracování formuláře
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->getModel('User');
            
            $userId = $_SESSION['user_id'];
            $nickname = htmlspecialchars($_POST['nickname'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($nickname)) {
                $_SESSION['messages']['error'][] = "Přezdívka nesmí být prázdná.";
                header('Location: ' . BASE_URL . '/index.php?url=user/settings');
                exit;
            }

            // Aktualizace v modelu
            if ($userModel->updateSettings($userId, $nickname, $password)) {
                // Přepíšeme jméno v Session, aby se to hned projevilo nahoře
                $_SESSION['user_name'] = $nickname;
                $_SESSION['messages']['success'][] = "Profil byl úspěšně aktualizován.";
            } else {
                $_SESSION['messages']['error'][] = "Při ukládání dat nastala chyba.";
            }

            header('Location: ' . BASE_URL . '/index.php?url=user/settings');
            exit;
        }
    }
}