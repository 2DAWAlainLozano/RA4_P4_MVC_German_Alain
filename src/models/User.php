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

    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM `USERS` ORDER BY `CREATED_AT` DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM `USERS` WHERE `ID_USER` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateRole($id, $role) {
        $stmt = $this->db->prepare("UPDATE `USERS` SET `ROLE` = ? WHERE `ID_USER` = ?");
        return $stmt->execute([$role, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM `USERS` WHERE `ID_USER` = ?");
        return $stmt->execute([$id]);
    }
}
