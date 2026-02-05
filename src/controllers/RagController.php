<?php
require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../models/Retriever.php';
require_once __DIR__ . '/../models/LLM.php';
require_once __DIR__ . '/../utils/Csrf.php';
use Utils\Csrf;


class RagController {
    private $db;
    private $retriever;
    private $llm;

    public function __construct() {
        $database = new Database();
        $this->db = $database->pdo;
        $this->retriever = new Retriever($this->db);
        $this->llm = new LLM();
    }

    public function index() {
        $this->render('rag/index.php');
    }

    public function ask() {
        if (!Csrf::validate($_POST['csrf_token'] ?? '')) {
            die("CSRF Token invalido");
        }
        $question = $_POST['question'] ?? '';

        $answer = '';
        $results = [];

        if (!empty($question)) {
            // 1. Retrieve relevant documents
            $results = $this->retriever->search($question);

            // 2. Build Context
            $context = "";
            foreach ($results as $result) {
                $context .= "Título: " . $result['TITLE'] . "\n";
                $context .= "Contenido: " . $result['CONTENT'] . "\n\n";
            }

            // 3. Generate Answer
            $answer = $this->llm->generate($question, $context);
        }

        $this->render('rag/index.php', [
            'question' => $question,
            'answer' => $answer,
            'results' => $results
        ]);
    }

    protected function render($view, $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }
}
