<?php

require_once './config/config.php';

class reviewModel {

    private $db;

    public function __construct() {
        $this->db = new PDO(
                              "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
                               MYSQL_USER, MYSQL_PASS
        );
    }
    public function getReview($orderBy = false) {
         $sql = 'SELECT * FROM reseña';
        if($orderBy) {
            switch($orderBy) {
                case 'puntuacion':
                    $sql .= ' ORDER BY puntuacion';
                    break;
                case 'opinion':
                    $sql .= ' ORDER BY opinion';
                    break;
                default:
                 break;
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $review = $query->fetchAll(PDO::FETCH_OBJ);

        return $review;
    }
}