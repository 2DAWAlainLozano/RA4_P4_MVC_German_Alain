<?php

class Retriever {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function search($query) {
        // Prepare the query using MySQL FULLTEXT search
        // We select the ID, Title, Content and the match score
        $sql = "SELECT `ID_POST`, `TITLE`, `CONTENT`, 
                MATCH(`TITLE`, `CONTENT`) AGAINST(:query IN NATURAL LANGUAGE MODE) as score 
                FROM `POSTS` 
                WHERE MATCH(`TITLE`, `CONTENT`) AGAINST(:query IN NATURAL LANGUAGE MODE) 
                ORDER BY score DESC 
                LIMIT 5";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':query', $query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
