<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Comment.php';

class CommentController {
    private $db;
    private $commentModel;

    public function __construct() {
        $database = new Database();
        $this->db = $database->pdo;
        $this->commentModel = new Comment($this->db);
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $postId = $_POST['post_id'] ?? null;
        $content = trim($_POST['content'] ?? '');

        if ($postId && !empty($content)) {
            $success = $this->commentModel->insert($content, $_SESSION['user_id'], $postId);
            
            if ($success) {
                $this->sendCommentCreatedWebhook($postId, $content);
            }
        }

        header("Location: index.php?action=show&id=" . $postId);
        exit;
    }

    private function sendCommentCreatedWebhook($postId, $text) {
        $url = getenv('N8N_WEBHOOK_COMMENT_CREATED');
        $token = getenv('N8N_SHARED_TOKEN');
        
        if (!$url) return;

        $data = [
            'post_id' => $postId,
            'text' => $text,
            'user_id' => $_SESSION['user_id']
        ];

        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n" .
                             "X-Shared-Token: " . $token . "\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
                'ignore_errors' => true
            ]
        ];

        $context  = stream_context_create($options);
        @file_get_contents($url, false, $context);
    }
}
