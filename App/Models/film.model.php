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
    
    
    public function getFilms() {
        // Ejecuto consulta sobre las peliculas.
        $query = $this->db->prepare('SELECT * FROM peliculas');
        // Guardo la consulta en $query y la ejecuto.
        $query->execute();

        // Con el fetchAll me traigo todos los datos, ya que el
        // SELECT * FROM peliculas trae la tabla completa.
        $films = $query->fetchAll(PDO::FETCH_OBJ);

        return $films;
    }

    public function insertFilm($name_film, $date, $director, $genre, $language, $id_productoras, $image = null) {
        $pathImg = null;
        
        // Verificar si se ha subido una imagen
        if ($image) {
            $pathImg = $this->uploadImage($image); // Llama a la función uploadImage
        }
    
        // Inserta la película en la base de datos
        $query = $this->db->prepare('INSERT INTO peliculas (Nombre_pelicula, Lanzamiento, director, Idioma, genero, id_productora, imagen_pelicula) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $query->execute([$name_film, $date, $director, $language, $genre, $id_productoras, $pathImg]);
    
        // Obtiene el ID de la última película insertada
        $id_peliculas = $this->db->lastInsertId();
    
        return $id_peliculas;
    }

    public function cleanFilm($id_peliculas) {
        $query = $this->db->prepare('DELETE FROM peliculas WHERE id_peliculas = ?');
        $query->execute([$id_peliculas]);
    }

    public function updateFilm($id_peliculas, $name_film, $date, $director, $genre, $language, $id_productoras, $image = null) {
        $pathImg = null;
    
        // Verificar si hay una nueva imagen
        if (isset($image['tmp_name']) && !empty($image['tmp_name'])) {
            $pathImg = $this->uploadImage($image);
        } else {
            // Aquí puedes establecer el valor actual de la imagen de la base de datos si deseas mantenerlo
            $film = $this->getFilmById($id_peliculas);
            $pathImg = $film->imagen_pelicula; // Asegúrate de que el nombre de la propiedad coincida
        }
    
        // Actualizo los datos de la película en la base de datos
        $query = $this->db->prepare('UPDATE peliculas SET Nombre_pelicula = ?, Lanzamiento = ?, director = ?, genero = ?, Idioma = ?, id_productora = ?, imagen_pelicula = ? WHERE id_peliculas = ?');
        $query->execute([$name_film, $date, $director, $genre, $language, $id_productoras, $pathImg, $id_peliculas]);
    }
    

    public function getFilmById($id_peliculas) {
        // Aquí se une a la tabla de productoras para obtener el nombre de la productora
        $query = $this->db->prepare('SELECT p.*, pr.Nombre_productora FROM peliculas p JOIN productoras pr ON p.id_productora = pr.id_productora WHERE p.id_peliculas = ?');
        $query->execute([$id_peliculas]);
    
        return $query->fetch(PDO::FETCH_OBJ);
    }
   
    private function uploadImage($image) {
        // Define la ruta de destino para la imagen
        $targetDir = 'img/task/';
    
        // Verifica si la carpeta existe, si no, intenta crearla
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true); // Crea la carpeta con permisos
        }
    
        // Genera el nombre de archivo
        $targetFile = $targetDir . uniqid() . '.jpg';
        
        // Intenta mover el archivo subido
        if (move_uploaded_file($image['tmp_name'], $targetFile)) {
            return $targetFile; // Retorna la ruta de la imagen
        } else {
            throw new Exception('Error al mover el archivo subido.');
        }
    }
}