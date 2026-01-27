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
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user_id'];
            $imagePath = null;

            // Image Upload Logic
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $fileTmpPath = $_FILES['image']['tmp_name'];
                $fileName = basename($_FILES['image']['name']);
                $fileSize = $_FILES['image']['size'];
                $fileType = $_FILES['image']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                // Sanitize file name
                $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                
                $allowedfileExtensions = array('jpg', 'gif', 'png', 'webp', 'jpeg');

                if (in_array($fileExtension, $allowedfileExtensions) && $fileSize < 2 * 1024 * 1024) {
                    $dest_path = $uploadDir . $newFileName;
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        $imagePath = 'uploads/' . $newFileName;
                    }
                }
            }

            if ($this->postModel->insert($title, $content, $userId, $imagePath)) {
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
