<?php
require_once './App/Models/producer.model.php';
require_once './App/Views/json.view.php';
 class producerController {
    private $model;
    private $view;

    // Constructor 
    public function __construct() {
        // Instancio 
        $this->model = new producerModel();
        // Instancio 
        $this->view = new JSONView();
    }
    public function showProducers($req, $res) {
        $filtro = false;
        $valor = false;
    
        // Verificar si se pasan los parámetros 'filtro' y 'valor'
        if ((isset($req->query->filtro)) && (isset($req->query->valor))) {
            $filtro = $req->query->filtro;
            $valor = $req->query->valor;
        }
    
        // Llamar al modelo para obtener los productores según el filtro
        $producers = $this->model->getProducers($filtro, $valor);
    
        // Retornar la respuesta en formato JSON
        return $this->view->response($producers);
    }
    public function seeProducer($req, $res) {
        $id = $req->params->id;
        $producer = $this->model->getProducer($id);
       // Verificar si la productora existe
        if ($producer) {
            return $this->view->response($producer);
        } else {
            return $this->view->response("No se encontró ninguna productora con el ID=$id ", 404);
        }
       
    }
    public function seeDetail($req, $res) {
        $id = $req->params->id;
        $films= $this->model->getFilmsFromAProducers($id);
       // Verificar si la productora existe
        if ($films) {
            return $this->view->response($films);
        } else {
            return $this->view->response('No se encontró ninguna pelicula con esa productora ', 404);
        }
    }

    public function addProducer($req, $res) {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $body=$req->body;
        if (empty($body['nombre_productora'])) {
            return $this->view->response('Falta completar el nombre de la productora',404);
        }
        if (empty($body['año_fundacion'])) {
            return $this->view->response('Falta completar el año de fundacion', 404);
        }
        if (empty($body['fundador_es'])) {
            return $this->view->response('Falta completar el/los fundadores', 404);
        }
        if (empty($body['pais_origen'])) {
            return $this->view->response('Falta completar el pais de origen', 404);
        }
     
        $name_producer = $body['nombre_productora'];
        $year_foundation =$body['año_fundacion'];
        $founders = $body['fundador_es'];
        $country_origin =$body['pais_origen'];
      
        $id_producer = $this->model->insertProducer($name_producer, $year_foundation, $founders, $country_origin);
    
        if ($id_producer) {
            return $this->view->response("La productora se agrego con exito con el id=$id_producer",201);
        } else {
            return $this->view->response('Error: no se pudo agregar la productora.', 404);
        }
    }
    
    
    public function deleteProducer($req, $res){
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $producers=$this->model-> getProducer($id);
        if (!$producers) {
            return $this->view->response("no existe la productora con el id=$id", 404);
        }
        $result = $this->model->deleteProducer($id);

        if ($result === true) {
            $this->view->response("La productora con el id=$id se eliminó con éxito");
        } elseif ($result === 'foreign_key_error') {
            $this->view->response("No se puede eliminar la productora porque tiene películas asociadas.", 404);
        } else {
            // Manejar otros errores inesperados
            $this->view->response("Ocurrió un error inesperado al intentar eliminar la productora.", 404);
        }

    }

    public function modifyProducers($req, $res) {
        if (!$res->user) {
            return $this->view->response("No autorizado", 401);
        }
        $id = $req->params->id;
        $task = $this->model->getProducer($id);
        if (!$task) {
            return $this->view->response("La tarea con el id=$id no existe", 404);
        }


            // Validación de los campos del formulario
            $body=$req->body;
        if (empty($body['nombre_productora'])) {
            return $this->view->response('Falta completar el nombre de la productora',404);
        }
        if (empty($body['año_fundacion'])) {
            return $this->view->response('Falta completar el año de fundacion', 404);
        }
        if (empty($body['fundador_es'])) {
            return $this->view->response('Falta completar el/los fundadores', 404);
        }
        if (empty($body['pais_origen'])) {
            return $this->view->response('Falta completar el pais de origen', 404);
        }
    
        $name_producer = $body['nombre_productora'];
        $year_foundation =$body['año_fundacion'];
        $founders = $body['fundador_es'];
        $country_origin =$body['pais_origen'];
      
            // Llama al modelo para modificar el productor
           $this->model->modifyProducer($name_producer, $year_foundation, $founders, $country_origin, $id);
            $modify=$this->model->getProducer($id);
            return $this->view->response($modify, 200);
        
    }
    
    


}

