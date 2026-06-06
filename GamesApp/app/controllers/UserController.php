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

        // NAČTENÍ EMAILU Z DATABÁZE:
        $userModel = $this->getModel('User');
        $userData = $userModel->getUserById($_SESSION['user_id']);

        if ($userData) {
            // Předpokládám, že se sloupec v databázi jmenuje 'email'
            // Uložíme ho do session, aby ho tvůj pohled (settings.php) mohl přečíst
            $_SESSION['user_email'] = $userData['email'];
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
    } // <--- TADY CHYBĚLA TATO ZÁVORKA PRO UKONČENÍ FUNKCE update()

    // Zpracování smazání účtu
    public function delete() {
        // Pokud uživatel není přihlášený, vyhodíme ho na hlavní stránku
        if (!isset($_SESSION['user_id'])) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        require_once __DIR__ . '/../models/Database.php';
        require_once __DIR__ . '/../models/User.php';
        
        $db = new Database();
        $userModel = new User($db->getConnection());

        // Zavoláme metodu z modelu pro smazání z DB
        if ($userModel->deleteUser($_SESSION['user_id'])) {
            
            // Účet byl smazán v DB, musíme zničit session (odhlásit ho)
            $_SESSION = [];
            session_destroy();
            
            // Nastartujeme novou čistou session jen proto, abychom ukázali zprávu o úspěchu
            session_start();
            $_SESSION['messages']['success'][] = "Tvůj účet byl úspěšně a trvale smazán.";
            header('Location: ' . BASE_URL . '/index.php');
            exit;
            
        } else {
            // Pokud se něco pokazilo v databázi
            $_SESSION['messages']['error'][] = "Při mazání účtu došlo k chybě.";
            header('Location: ' . BASE_URL . '/index.php?url=user/settings');
            exit;
        }
    }
}