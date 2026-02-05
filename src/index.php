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
require_once 'controllers/AdminController.php';
require_once 'controllers/RagController.php';

$action = $_GET['action'] ?? 'posts';

switch ($action) {
    case 'rag':
        $controller = new RagController();
        $controller->index();
        break;
    case 'rag_ask':
        $controller = new RagController();
        $controller->ask();
        break;
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
    // Admin routes
    case 'admin':
        $controller = new AdminController();
        $controller->dashboard();
        break;
    case 'admin_users':
        $controller = new AdminController();
        $controller->users();
        break;
    case 'admin_update_role':
        $controller = new AdminController();
        $controller->updateUserRole();
        break;
    case 'admin_delete_user':
        $controller = new AdminController();
        $controller->deleteUser();
        break;
    case 'admin_posts':
        $controller = new AdminController();
        $controller->posts();
        break;
    case 'admin_edit_post':
        $controller = new AdminController();
        $controller->editPost();
        break;
    case 'admin_update_post':
        $controller = new AdminController();
        $controller->updatePost();
        break;
    case 'admin_delete_post':
        $controller = new AdminController();
        $controller->deletePost();
        break;
    case 'admin_comments':
        $controller = new AdminController();
        $controller->comments();
        break;
    case 'admin_delete_comment':
        $controller = new AdminController();
        $controller->deleteComment();
        break;
    default:
        http_response_code(440);
        echo "<h1>404 - Página no encontrada</h1>";
        break;
}

