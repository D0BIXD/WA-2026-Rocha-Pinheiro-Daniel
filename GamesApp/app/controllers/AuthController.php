<?php

class AuthController {

    private function getModel($modelName) {
        require_once '../app/models/Database.php';
        require_once '../app/models/' . $modelName . '.php';
        $database = new Database();
        return new $modelName($database->getConnection());
    }

    public function register() {
        require_once '../app/views/auth/register.php';
    }

    public function storeUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->getModel('User');
            $username = htmlspecialchars($_POST['username'] ?? '');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $nickname = htmlspecialchars($_POST['nickname'] ?? '');

            // VALIDACE HESLA: min 6 znaků a alespoň jedna číslice
            if (strlen($password) < 6 || !preg_match('/\d/', $password)) {
                $_SESSION['messages']['error'][] = "Heslo musí mít alespoň 6 znaků a obsahovat alespoň jednu číslici.";
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
                exit;
            }

            if ($userModel->register($username, $email, $password, $nickname)) {
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            } else {
                $_SESSION['messages']['error'][] = "Registrace selhala (email již existuje?).";
                header('Location: ' . BASE_URL . '/index.php?url=auth/register');
            }
            exit;
        }
    }

    public function login() {
        require_once '../app/views/auth/login.php';
    }

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = $this->getModel('User');
            $email = htmlspecialchars($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = !empty($user['nickname']) ? $user['nickname'] : $user['username'];
                $_SESSION['is_admin'] = $user['is_admin'] ?? 0;
                header('Location: ' . BASE_URL . '/index.php');
           } else {
                // TADY PŘIDÁVÁME CHYBOVOU ZPRÁVU
                $_SESSION['messages']['error'][] = "Neplatný e-mail nebo heslo.";
                header('Location: ' . BASE_URL . '/index.php?url=auth/login');
            }
            exit;
        }
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['is_admin']);
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}