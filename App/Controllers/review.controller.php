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
        // Instancio 
        $this->view = new JSONView();
    }
    public function showReview($req, $res) {
        $orderBy = false;
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;

        $review = $this->model->getReview($orderBy);
       
        return $this->view->response($review);
    }
   
    
    


}

