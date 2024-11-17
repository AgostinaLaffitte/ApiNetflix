<?php
// Aqui las carpetas ajenas a esta, la cual usaremos sus archivos.
require_once './App/Models/film.model.php';
require_once './App/Views/json.view.php';
require_once './App/Models/producer.model.php';


class FilmsController {
    private $model;
    private $view;
    private $producerModel;


    public function __construct() {
        // Instancio el modelo de películas
        $this->model = new FilmsModel();

        // Instancio la vista de películas 
        $this->view =new JSONView();

        // Instancio el modelo de productoras
        $this->producerModel = new producerModel(); 

    }
    
    public function showFilms($req, $res) {
        // Obtener el parámetro 'id_productora' de la URL o de los parámetros de la consulta
        if (isset($req->query['id_productora'])) {
            $id_productora = $req->query['id_productora'];
        } else {
            $id_productora = null;
        }
    
        // Obtener el parámetro 'campo' (campo por el cual ordenar) de la URL o parámetros de consulta
        if (isset($req->query['campo'])) {
            $campo = $req->query['campo'];
        } else {
            $campo = 'id_peliculas'; 
        }
    
        // Obtener el parámetro 'order' (dirección del orden: asc o desc) de la URL o parámetros de consulta
        if (isset($req->query['order']) && in_array(strtolower($req->query['order']), ['asc', 'desc'])) {
            $order = strtoupper($req->query['order']);
        } else {
            $order = 'ASC'; 
        }
    
        // Obtener las películas filtradas
        $films = $this->model->getFilms($id_productora, $campo, $order);
    
        $producers = $this->producerModel->getProducers(); 
    
        return $this->view->response($films, $producers); 
    }
    
    public function showHome($req, $res) {
        // Obtener el parámetro 'id_productora' de la URL
        if (isset($req->query->id_productora)) {
            $id_productora = $req->query->id_productora;
        } else {
            $id_productora = null;
        }
    
        // Obtener el parámetro 'campo'
        if (isset($req->query->campo)) {
            $campo = $req->query->campo;
        } else {
            $campo = 'id_peliculas';
        }
    
        // Obtener el parámetro 'order'
        if (isset($req->query->order) && in_array(strtolower($req->query->order), ['asc', 'desc'])) {
            $order = strtoupper($req->query->order);
        } else {
            $order = 'ASC';
        }
    
        $films = $this->model->getFilms($id_productora, $campo, $order);
    
        // Devolver la respuesta con las películas filtradas (o todas si no hay parámetro)
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

    public function addFilm($req, $res) {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
       $body=$req->body;

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
      
            // Obtengo los datos del formulario
          $name_film =$body['Nombre_pelicula'];
          $date =$body['Lanzamiento'];
          $director =$body['director'];
          $genre = $body['genero'];
          $language =$body['Idioma'];
          $id_producers =$body['id_productora']; 
          
          $producers=$this->producerModel->getProducer($id_producers);
          if (empty($producers)) {
            return $this->view->response("no existe la productora con el id=$id_producers",404);
          }
         
      
          // Insento la pelicula
          $id_peliculas = $this->model->insertFilm($name_film, $date, $director, $genre, $language, $id_producers);
  
      
          // Verificar si la inserción fue exitosa
          if ($id_peliculas) {
              // Redirigir al home
             return $this->view->response("se agrego con exito la pelicula con el id=$id_peliculas.", 201);
             
          } else {
              return $this->view->response('Error al agregar la película. Por favor, inténtelo de nuevo.');
          }
    }
    
    
    public function deleteFilm($req, $res) {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id_pelicula = $req->params->id;
        
        // Obtener la película específica por su ID
        $film = $this->model->getFilmByIds($id_pelicula);
    
        if (!$film) {
            return $this->view->response("No existe la película con el id = $id_pelicula");
        }
    
        // Eliminar la película
        $this->model->cleanFilm($id_pelicula);
    
        return $this->view->response("Se borró con éxito la película con el id = $id_pelicula");
    }
    
    
    public function editFilm($req, $res){
        
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $body=$req->body;
        $id_pelicula = $req->params->id;
        // Obtengo la película específica por id
        $film = $this->model->getFilmById($id_pelicula); // Usa getFilmById para obtener una película
    
        if (!$film) {
            return $this->view->response("No existe la película con el id = $id_pelicula");
        }
    
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
          
    
         // Obtengo los datos del formulario
          $name_film =$body['Nombre_pelicula'];
          $date =$body['Lanzamiento'];
          $director =$body['director'];
          $genre = $body['genero'];
          $language =$body['Idioma'];
          $id_producers =$body['id_productora']; 
        
          $producers=$this->producerModel->getProducer($id_producers);
          if (empty($producers)) {
            return $this->view->response("no existe la productora con el id=$id_producers",404);
          }
         
            // Llamo al modelo para actualizar los datos
            $this->model->updateFilm($id_pelicula, $name_film, $date, $director, $genre, $language, $id_producers);
            $film= $this->model->getFilmById($id_pelicula);
            return $this->view->response($film); 
           
        
    
    }
    
}