<?php

require_once './config/config.php';

class FilmsModel {
    private $db;

    public function __construct() {
        $this->db = new PDO(
                              "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
                               MYSQL_USER, MYSQL_PASS
        );
    }
    
    
    public function getFilms($id_productora = null, $campo = 'id_peliculas', $order = 'ASC') {
        // Validar el campo de ordenación (solo permitir campos válidos)
        $valid_columns = ['id_peliculas', 'Nombre_pelicula', 'Lanzamiento', 'director', 'Idioma', 'genero', 'id_productora'];
        if (!in_array($campo, $valid_columns)) {
            $campo = 'id_peliculas';
        }
    
        // Validar la dirección (ascendente o descendente)
        $order = strtoupper($order) === 'DESC' ? 'DESC' : 'ASC'; 
    
        // Si se pasa un id_productora, se agrega un filtro en la consulta
        if ($id_productora) {
            $query = $this->db->prepare("SELECT * FROM peliculas WHERE id_productora = ? ORDER BY $campo $order");
            $query->execute([$id_productora]);
        } else {
            $query = $this->db->prepare("SELECT * FROM peliculas ORDER BY $campo $order");
            $query->execute();
        }
    
        $films = $query->fetchAll(PDO::FETCH_OBJ);
    
        return $films;
    }
    
    public function getFilmByIds($id_peliculas) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_peliculas = ?');
        $query->execute([$id_peliculas]);
        
        // Devolver el primer resultado, que debe ser la película con ese ID
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function insertFilm($name_film, $date, $director, $genre, $language, $id_productoras) {
    
        // Inserta la película en la base de datos
        $query = $this->db->prepare('INSERT INTO peliculas (Nombre_pelicula, Lanzamiento, director, Idioma, genero, id_productora) VALUES ( ?, ?, ?, ?, ?, ?)');
        $query->execute([$name_film, $date, $director, $language, $genre, $id_productoras]);
    
        // Obtiene el ID de la última película insertada
        $id_peliculas = $this->db->lastInsertId();
    
        return $id_peliculas;
    }

    public function cleanFilm($id_peliculas) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id_peliculas = ?');
        $query->execute([$id_peliculas]);
    }

    public function updateFilm($id_pelicula, $name_film, $date, $director, $genre, $language, $id_productoras) {
   
        // Actualizo los datos de la película en la base de datos
        $query = $this->db->prepare('UPDATE peliculas SET Nombre_pelicula = ?, Lanzamiento = ?, director = ?, genero = ?, Idioma = ?, id_productora = ? WHERE id_peliculas = ?');
        $query->execute([$name_film, $date, $director, $genre, $language, $id_productoras, $id_pelicula]);
        
    }
    

    public function getFilmById($id_peliculas) {
        // Aquí se une a la tabla de productoras para obtener el nombre de la productora
        $query = $this->db->prepare('SELECT p.*, pr.Nombre_productora FROM peliculas p JOIN productoras pr ON p.id_productora = pr.id_productora WHERE p.id_peliculas = ?');
        $query->execute([$id_peliculas]);
    
        return $query->fetch(PDO::FETCH_OBJ);
    }
   
   
}