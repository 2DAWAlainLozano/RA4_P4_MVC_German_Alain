<?php
class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getByPostId($postId) {
        $stmt = $this->db->prepare("SELECT `COMMENTS`.*, `USERS`.`NAME` as user_name FROM `COMMENTS` JOIN `USERS` ON `COMMENTS`.`ID_USER` = `USERS`.`ID_USER` WHERE `ID_POST` = ? ORDER BY `CREATED_AT` DESC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    public function insert($content, $userId, $postId) {
        $stmt = $this->db->prepare("INSERT INTO `COMMENTS` (`CONTENT`, `ID_USER`, `ID_POST`) VALUES (?, ?, ?)");
        return $stmt->execute([$content, $userId, $postId]);
    }

    public function getAll() {
        $stmt = $this->db->prepare("SELECT `COMMENTS`.*, `USERS`.`NAME` as user_name, `POSTS`.`TITLE` as post_title FROM `COMMENTS` JOIN `USERS` ON `COMMENTS`.`ID_USER` = `USERS`.`ID_USER` JOIN `POSTS` ON `COMMENTS`.`ID_POST` = `POSTS`.`ID_POST` ORDER BY `COMMENTS`.`CREATED_AT` DESC");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM `COMMENTS` WHERE `ID_COMMENT` = ?");
        return $stmt->execute([$id]);
    }
}
