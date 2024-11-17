<?php
require_once './App/Models/review.model.php';
require_once './App/Views/json.view.php';
 class reviewController {
    private $model;
    private $view;

    // Constructor 
    public function __construct() {
        // Instancio 
        $this->model = new reviewModel();
        $this->filmModel = new FilmsModel ();

        $this->view = new JSONView();
    }
    public function showReview($req, $res) {
        $orderBy = false;
        $direccion = null;
        if(isset($req->query->orderBy)){
            $orderBy = $req->query->orderBy;
            if (isset($req->query->direccion))
            $direccion = $req->query->direccion;
        }
        try {
            // Intentamos obtener las reseñas
            $review = $this->model->getReview($orderBy, $direccion);
            return $this->view->response($review);
        } catch (InvalidArgumentException $e) {
            // Si ocurre un error, devolvemos un mensaje claro al cliente
            return $this->view->response([
                "error" => $e->getMessage()
            ], 400); 
        }
    }
    public function addReview($req, $res) {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }   
       $body=$req->body;

        // Validación de campos obligatorios
        if (empty($body['nombre_usuario'])) {
            return $this->view->response('Falta completar nombre', 404);
        }
        if (empty($body['opinion'])) {
            return $this->view->response('Falta completar opinion', 404);
        }
        if (empty($body['puntuacion'])) {
            return $this->view->response('Falta completar puntuacion',404);
        }
        if (empty($body['id_pelicula'])) {
            return $this->view->response('Falta completar la pelicula',404);
        }
      
            // Obtengo los datos del formulario
          $user= $body['nombre_usuario'];
          $opinion =$body['opinion'];
          $score =$body['puntuacion'];
          $id_film=$body['id_pelicula'];
          $date_published = (new DateTime())->format('Y-m-d');
       
          $film=$this->filmModel->getFilmByIds($id_film);
          if (empty($film)) {
            return $this->view->response("no existe la pelicula con el id=$id_film",404);
          }
         
      
          // Insento la pelicula
          $id_review = $this->model->insertReview($user,$opinion,$score,$id_film,$date_published);
  
      
          // Verificar si la inserción fue exitosa
          if ($id_review) {
              // Redirigir al home
             return $this->view->response("se agrego con exito la reseña con el id=$id_review.", 201);
             
          } else {
              return $this->view->response('Error al agregar la reseña. Por favor, inténtelo de nuevo.');
          }
    }
    public function deleteReview($req, $res){
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $review=$this->model-> getReviewByIds($id);
        if (!$review) {
            return $this->view->response("no existe la reseña con el id=$id", 404);
        }
        $this->model->deleteReview($id);
        return $this->view->response("La reseña con el id=$id se eliminó con éxito");
    }
    public function modifyReview($req, $res){
        
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $body=$req->body;
        $id_review = $req->params->id;
        // Obtengo la película específica por id
        $review = $this->model->getReviewByIds($id_review); 
    
        if (!$review) {
            return $this->view->response("No existe la reseña con el id = $id_review");
        }
    
          // Validación de campos obligatorios
        if (empty($body['nombre_usuario'])) {
            return $this->view->response('Falta completar nombre', 404);
        }
        if (empty($body['opinion'])) {
            return $this->view->response('Falta completar opinion', 404);
        }
        if (empty($body['puntuacion'])) {
            return $this->view->response('Falta completar puntuacion',404);
        }
        if (empty($body['id_pelicula'])) {
            return $this->view->response('Falta completar la pelicula',404);
        }
      
            // Obtengo los datos del formulario
          $user=$body['nombre_usuario'];
          $opinion =$body['opinion'];
          $score =$body['puntuacion'];
          $id_film=$body['id_pelicula'];
        
          $film=$this->filmModel->getFilmByIds($id_film);
          if (empty($film)) {
            return $this->view->response("no existe la pelicula con el id=$id_film",404);
          }
         
            // Llamo al modelo para actualizar los datos
            $this->model->updateReview($user,$opinion,$score,$id_film,$id_review);
            $review= $this->model->getReviewById($id_review);
            return $this->view->response($review); 
           
        
    
    }
   
    
    


}

