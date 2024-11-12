<?php

require_once './config/config.php';

class producerModel {

    private $db;

    public function __construct() {
        $this->db = new PDO(
                              "mysql:host=" . MYSQL_HOST . ";dbname=" . MYSQL_DB . ";charset=utf8", 
                               MYSQL_USER, MYSQL_PASS
        );
    }
    public function getFilmsFromAProducers($id){
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_productora = ?');
        $query->execute([$id]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function getProducers() {

        $query = $this->db->prepare('SELECT * FROM productoras');
        $query->execute();
        $producers = $query->fetchAll(PDO::FETCH_OBJ);

        return $producers;
    }
    public function getProducer($id) {
        $query = $this->db->prepare('SELECT * FROM productoras WHERE id_productora = ?');
        $query->execute([$id]);
        $producer = $query->fetch(PDO::FETCH_OBJ);


        return $producer;
    }
    public function insertProducer($name_producer, $year_foundation, $founders, $country_origin, $image = null) {
        $pathImg = null;
        if ($image) {
            $pathImg = $this->uploadImage($image); // Esto debe funcionar correctamente
        } else {
            return null; // O lanza una excepción si no hay imagen
        }
    
        $query = $this->db->prepare('INSERT INTO productoras(nombre_productora, año_fundacion, fundador_es, pais_origen, imagen_productora) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$name_producer, $year_foundation, $founders, $country_origin, $pathImg]);
    
        $id_producer = $this->db->lastInsertId();
        return $id_producer;
    }
    
    public function deleteProducer($id){
        try {
            $query = $this->db->prepare("DELETE FROM productoras WHERE id_productora = ?");
            $query->execute([$id]);
            return true; // Devuelve true si la eliminación fue exitosa
        } catch (PDOException $e) {
            // Si hay una violación de clave foránea, propagamos el error al controlador
            if ($e->getCode() == '23000') { 
                return 'foreign_key_error'; 
            } else {
                throw $e; 
            }
        }

    }
    public function modifyProducer($name_producer, $year_foundation, $founders, $country_origin, $id, $image = null) {
        // Obtener el productor existente para conservar la imagen actual si no se proporciona una nueva
        $producer = $this->getProducer($id);
        $pathImg = $producer->imagen_productora; // Obtén la imagen actual
    
        // Verificar si hay una nueva imagen
        if ($image && isset($image['tmp_name']) && !empty($image['tmp_name'])) {
            $pathImg = $this->uploadImage($image); // Sube la nueva imagen y actualiza la ruta
        }
    
        // Actualizar los datos de la productora en la base de datos
        $query = $this->db->prepare('UPDATE productoras SET nombre_productora = ?, año_fundacion = ?, fundador_es = ?, pais_origen = ?, imagen_productora = ? WHERE id_productora = ?');
        $query->execute([$name_producer, $year_foundation, $founders, $country_origin, $pathImg, $id]);
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

