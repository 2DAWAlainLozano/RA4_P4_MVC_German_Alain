<?php
session_start();
// Cargar variables de entorno desde .env si existe
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (getenv($name) === false) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}


require_once 'controllers/PostController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/CommentController.php';

$action = $_GET['action'] ?? 'posts';

switch ($action) {
    case 'posts':
        $controller = new PostController();
        $controller->index();
        break;
    case 'show':
        $id = $_GET['id'] ?? null;
        $controller = new PostController();
        $controller->show($id);
        break;
    case 'login':
        $controller = new UserController();
        $controller->login();
        break;
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
    case 'logout':
        $controller = new UserController();
        $controller->logout();
        break;
    case 'add_comment':
        $controller = new CommentController();
        $controller->store();
        break;
    case 'upload':
        $controller = new PostController();
        $controller->upload();
        break;
    case 'store_post':
        $controller = new PostController();
        $controller->store();
        break;
    default:
        http_response_code(440);
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}
