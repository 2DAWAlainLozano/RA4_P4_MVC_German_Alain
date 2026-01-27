<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';

class UserController {
    private $db;
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->pdo;
        $this->userModel = new User($this->db);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['ID_USER'];
                $_SESSION['user_name'] = $user['NAME'];
                $_SESSION['user_role'] = $user['ROLE'];
                header('Location: index.php?action=posts');
                exit;
            } else {
                $error = "Credenciales inválidas";
                $this->render('auth/login.php', ['error' => $error]);
            }
        } else {
            $this->render('auth/login.php');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            if ($this->userModel->register($name, $email, $password)) {
                header('Location: index.php?action=login');
                exit;
            } else {
                $error = "Error al registrar usuario";
                $this->render('auth/register.php', ['error' => $error]);
            }
        } else {
            $this->render('auth/register.php');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: index.php?action=posts');
        exit;
    }

    protected function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }
}
