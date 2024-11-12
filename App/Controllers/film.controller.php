<?php
// Aqui las carpetas ajenas a esta, la cual usaremos sus archivos.
require_once './App/Models/film.model.php';
require_once './App/Views/film.view.php';
require_once './App/Models/producer.model.php';


class FilmsController {
    private $model;
    private $view;
    private $producerModel;


    // Constructor para inicializar el modelo y la vista
    public function __construct() {
        // Instancio el modelo de películas
        $this->model = new FilmsModel();

        // Instancio la vista de películas 
        $this->view =new JSONView();

        // Instancio el modelo de productoras
        $this->producerModel = new producerModel(); 

    }
    
    public function showFilms($req, $res) {
        $films = $this->model->getFilms();
        // Obtengo las productoras
        $producers = $this->producerModel->getProducers(); 
        // las paso a la vista
        return $this->view->response($films, $producers); 
    }
    

    public function showHome($req, $res) {
        
        $films = $this->model->getFilms();
       
        return $this->view->response($films);
    }


    public function showFilmDetails($req, $res) {
        $id_peliculas = $req->params->id;
        // Obtengo la película específica por ID
        $film = $this->model->getFilmById($id_peliculas);
        
        // Obtengo todas las películas para mostrar debajo.
        $films = $this->model->getFilms();
    
        // Muestra la vista con los detalles de la película y la lista de otras películas
        $this->view->response($film);
    }

    public function showError($req, $res) {
        $error = $req->body;
        $this->view->response($error,404);
    }
    public function addFilm($req, $res) {
       $body=$req->body;
           // Depuración para ver qué datos están llegando
         
        // Validación de campos obligatorios
        if (empty($body['Nombre_pelicula'])) {
            return $this->view->response('Falta completar el nombre de la película', 404);
        }
        if (empty($body['Lanzamiento'])) {
            return $this->view->response('Falta completar la fecha de estreno',404);
        }
        if (empty($body['director'])) {
            return $this->view->response('Falta completar el nombre del director',404);
        }
        if (empty($body['genero'])) {
            return $this->view->response('Falta completar el género de la película',404);
        }
        if (empty($body['Idioma'])) {
            return $this->view->response('Falta completar el idioma de la película',404);
        }
        if (empty($body['id_productora'])) {
            return $this->view->response('Falta seleccionar una productora',404);
        }
        // Verificar si se ha recibido un archivo de imagen
          if (!isset($_FILES['imagen_pelicula']) || $_FILES['imagen_pelicula']['error'] !== UPLOAD_ERR_OK) {
            return $this->view->response('error con la imagen',404);
        }
       
            // Obtengo los datos del formulario
          $name_film =$body['Nombre_pelicula'];
          $date =$body['Lanzamiento'];
          $director =$body['director'];
          $genre = $body['genero'];
          $language =$body['Idioma'];
          $id_productoras =$body['id_productora']; 
          $img = $_FILES['imagen_pelicula'];
      
          // Insento la pelicula
          $id_peliculas = $this->model->insertFilm($name_film, $date, $director, $genre, $language, $id_productoras, $img );
  
      
          // Verificar si la inserción fue exitosa
          if ($id_peliculas) {
              // Redirigir al home
             return $this->view->response("se agrego con exito la pelicula con el id=$id_peliculas.");
             
          } else {
              return $this->view->response('Error al agregar la película. Por favor, inténtelo de nuevo.');
          }
    }
    
    
    public function deleteFilm($req, $res) {
        $id_pelicula = $req->params->id;
        // Obtengo la pelicula especifica por id
        $films = $this->model->getFilms($id_pelicula);

        if(!$films) {
            return $this->view->response("No existe la pelicula con el id = $id_pelicula");
        }

        // Borro y redirijo
        $this->model->cleanFilm($id_peliculas);

        return $this->view->response("Se borro con exito la pelicula con el id = $id_pelicula");
    }
    
    public function editFilm($req, $res){
        $id_pelicula = $req->params->id;
        // Obtengo la película específica por id
        $film = $this->model->getFilmById($id_pelicula); // Usa getFilmById para obtener una película
    
        if (!$film) {
            return $this->view->response("No existe la película con el id = $id_pelicula");
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validación de los campos del formulario
            if (empty($body['Nombre_pelicula'])) {
                return $this->view->response('Falta completar el nombre de la película', 404);
            }
            if (empty($body['Lanzamiento'])) {
                return $this->view->response('Falta completar la fecha de estreno',404);
            }
            if (empty($body['director'])) {
                return $this->view->response('Falta completar el nombre del director',404);
            }
            if (empty($body['genero'])) {
                return $this->view->response('Falta completar el género de la película',404);
            }
            if (empty($body['Idioma'])) {
                return $this->view->response('Falta completar el idioma de la película',404);
            }
            if (empty($body['id_productora'])) {
                return $this->view->response('Falta seleccionar una productora',404);
            }
            // Verificar si se ha recibido un archivo de imagen
              if (!isset($_FILES['imagen_pelicula']) || $_FILES['imagen_pelicula']['error'] !== UPLOAD_ERR_OK) {
                return $this->view->response('error con la imagen',404);
            }
    
         // Obtengo los datos del formulario
          $name_film =$body['Nombre_pelicula'];
          $date =$body['Lanzamiento'];
          $director =$body['director'];
          $genre = $body['genero'];
          $language =$body['Idioma'];
          $id_productoras =$body['id_productora']; 
          $img = $_FILES['imagen_pelicula'];; 
    
            // Llamo al modelo para actualizar los datos
            $this->model->updateFilm($id_peliculas, $name_film, $date, $director, $genre, $language, $id_productoras, $img);
            return $this->view->response($film); 
           
        }
    
    }
    
}