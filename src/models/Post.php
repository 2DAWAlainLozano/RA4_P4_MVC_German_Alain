<?php
class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT `POSTS`.*, `USERS`.`NAME` as author_name FROM `POSTS` JOIN `USERS` ON `POSTS`.`ID_USER` = `USERS`.`ID_USER` ORDER BY `CREATED_AT` DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT `POSTS`.*, `USERS`.`NAME` as author_name FROM `POSTS` JOIN `USERS` ON `POSTS`.`ID_USER` = `USERS`.`ID_USER` WHERE `POSTS`.`ID_POST` = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function insert($data) {
        $stmt = $this->db->prepare("INSERT INTO `POSTS` (`TITLE`, `CONTENT`, `ID_USER`) VALUES (?, ?, ?)");
        return $stmt->execute([$data['title'], $data['content'], $data['user_id']]);
    }
}
