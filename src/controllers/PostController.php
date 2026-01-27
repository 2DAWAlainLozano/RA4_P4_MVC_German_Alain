<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Comment.php';

class PostController {
    private $db;
    private $postModel;
    private $commentModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->pdo;
        $this->postModel = new Post($this->db);
        $this->commentModel = new Comment($this->db);
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            $posts = $this->postModel->getAll();
            $this->render('posts/index.php', ['posts' => $posts]);
        } else {
            $this->render('posts/landing.php');
        }
    }

    public function upload() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }
        $this->render('posts/upload.php');
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?action=login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'user_id' => $_SESSION['user_id']
            ];

            if ($this->postModel->insert($data)) {
                header('Location: index.php?action=posts');
                exit;
            } else {
                echo "Error al guardar el post";
            }
        }
    }

    public function show($id) {
        $post = $this->postModel->findById($id);
        if (!$post) {
            echo "Post no encontrado";
            return;
        }
        $comments = $this->commentModel->getByPostId($id);
        $this->render('posts/show.php', ['post' => $post, 'comments' => $comments]);
    }

    protected function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }
}
