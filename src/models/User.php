<?php
class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($name, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO `USERS` (`NAME`, `EMAIL`, `PASSWORD`) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $email, $hash]);
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM `USERS` WHERE `EMAIL` = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if ($user && password_verify($password, $user['PASSWORD'])) {
            return $user;
        }
        return false;
    }
}
