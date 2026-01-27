<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Comment.php';

class AdminController {
    private $db;
    private $userModel;
    private $postModel;
    private $commentModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->pdo;
        $this->userModel = new User($this->db);
        $this->postModel = new Post($this->db);
        $this->commentModel = new Comment($this->db);
    }

    private function requireAdmin() {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?action=posts');
            exit;
        }
    }

    public function dashboard() {
        $this->requireAdmin();
        $users = $this->userModel->getAll();
        $posts = $this->postModel->getAll();
        $comments = $this->commentModel->getAll();
        $this->render('admin/dashboard.php', [
            'userCount' => count($users),
            'postCount' => count($posts),
            'commentCount' => count($comments)
        ]);
    }

    public function users() {
        $this->requireAdmin();
        $users = $this->userModel->getAll();
        $this->render('admin/users.php', ['users' => $users]);
    }

    public function updateUserRole() {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_POST['user_id'] ?? null;
            $role = $_POST['role'] ?? null;
            if ($userId && $role) {
                $this->userModel->updateRole($userId, $role);
            }
        }
        header('Location: index.php?action=admin_users');
        exit;
    }

    public function deleteUser() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;
        if ($id && $id != $_SESSION['user_id']) {
            $this->userModel->delete($id);
        }
        header('Location: index.php?action=admin_users');
        exit;
    }

    public function posts() {
        $this->requireAdmin();
        $posts = $this->postModel->getAll();
        $this->render('admin/posts.php', ['posts' => $posts]);
    }

    public function deletePost() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->postModel->delete($id);
        }
        header('Location: index.php?action=admin_posts');
        exit;
    }

    public function editPost() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: index.php?action=admin_posts');
            exit;
        }
        $post = $this->postModel->findById($id);
        if (!$post) {
            header('Location: index.php?action=admin_posts');
            exit;
        }
        $this->render('admin/edit_post.php', ['post' => $post]);
    }

    public function updatePost() {
        $this->requireAdmin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            if ($id) {
                $this->postModel->update($id, $title, $content);
            }
        }
        header('Location: index.php?action=admin_posts');
        exit;
    }

    public function comments() {
        $this->requireAdmin();
        $comments = $this->commentModel->getAll();
        $this->render('admin/comments.php', ['comments' => $comments]);
    }

    public function deleteComment() {
        $this->requireAdmin();
        $id = $_GET['id'] ?? null;
        if ($id) {
            $this->commentModel->delete($id);
        }
        header('Location: index.php?action=admin_comments');
        exit;
    }

    protected function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }
}
