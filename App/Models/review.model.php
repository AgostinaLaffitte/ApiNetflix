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
    public function getReview($orderBy = false,  $direccion = " ASC") {
         $sql = 'SELECT * FROM reseña';
        if($orderBy) {
            switch($orderBy) {
                case 'usuario':
                    $sql .= ' ORDER BY usuario';
                    break;
                case 'puntuacion':
                    $sql .= ' ORDER BY puntuacion';
                    break;
                case 'opinion':
                    $sql .= ' ORDER BY opinion';
                    break;
                case 'pelicula':
                        $sql .= ' ORDER BY id_pelicula';
                        break;
                case 'fecha_publicado':
                            $sql .= ' ORDER BY fecha_publicado';
                            break;
                default:
                 throw new InvalidArgumentException("El valor de orderBy '$orderBy' no es válido.");
                  break;
                
            }
            if ($direccion === 'DESC') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }
        }

        $query = $this->db->prepare($sql);
        $query->execute();
        $review = $query->fetchAll(PDO::FETCH_OBJ);

        return $review;
    }
    public function insertReview($user,$opinion,$score,$id_film,$date_published) {
    
        $query = $this->db->prepare('INSERT INTO reseña ( nombre_usuario,opinion, puntuacion,id_pelicula, fecha_publicado) VALUES ( ?, ?, ?, ?,?)');
        $query->execute([$user,$opinion,$score,$id_film,$date_published]);
    
        $id_review = $this->db->lastInsertId();
        return $id_review;
    }
    public function delete($id_review) {
        $query = $this->db->prepare('DELETE FROM reseña WHERE id_reseña = ?');
        $query->execute([$id_review]);
    }
    public function updateReview($user,$opinion,$score,$id_film, $id_review) {
        // Actualizar los datos de la productora en la base de datos
        $query = $this->db->prepare('UPDATE reseña SET nombre_usuario= ?,opinion = ?, puntuacion = ?, id_pelicula = ? WHERE id_reseña = ?');
        $query->execute([$user,$opinion,$score,$id_film, $id_review]);
    }
    public function getReviewByIds($id_review) {
        $query = $this->db->prepare('SELECT * FROM reseña WHERE id_reseña = ?');
        $query->execute([$id_review]);
        
        // Devolver el primer resultado, que debe ser la película con ese ID
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
}