<?php
require_once 'config.php';

class Database {
    public $pdo;

    public function __construct() {
        $host = DB_HOST;
        $db   = DB_NAME;
        $user = DB_USER;
        $pass = DB_PASS;
        $charset = DB_CHARSET;

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        
        try {
            $this->pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        } catch (\PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
