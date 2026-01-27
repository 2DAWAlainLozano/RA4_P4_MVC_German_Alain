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

    public function insert($title, $content, $userId, $imagePath = null) {
        $stmt = $this->db->prepare("INSERT INTO `POSTS` (`TITLE`, `CONTENT`, `ID_USER`, `IMAGE_PATH`) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$title, $content, $userId, $imagePath]);
    }

    public function update($id, $title, $content) {
        $stmt = $this->db->prepare("UPDATE `POSTS` SET `TITLE` = ?, `CONTENT` = ? WHERE `ID_POST` = ?");
        return $stmt->execute([$title, $content, $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM `POSTS` WHERE `ID_POST` = ?");
        return $stmt->execute([$id]);
    }
}
