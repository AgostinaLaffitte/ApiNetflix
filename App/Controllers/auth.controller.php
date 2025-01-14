<?php
   require_once './App/Models/user.model.php';
    require_once './App/Views/json.view.php';
    require_once './Libs/jwt.php';

    class UserApiController {
        private $model;
        private $view;

        public function __construct() {
            $this->model = new UserModel();
            $this->view = new JSONView();
        }

        public function getToken() {
            // obtengo el email y la contraseña desde el header
            $auth_header = $_SERVER['HTTP_AUTHORIZATION']; 
            $auth_header = explode(' ', $auth_header); 
            if(count($auth_header) != 2) {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            if($auth_header[0] != 'Basic') {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            $user_pass = base64_decode($auth_header[1]); 
            $user_pass = explode(':', $user_pass); 
            // Buscamos El usuario en la base
            $user = $this->model->getUserByEmail($user_pass[0]);
            // Chequeamos la contraseña
            if($user == null || !password_verify($user_pass[1], $user->password)) {
                return $this->view->response("Error en los datos ingresados", 400);
            }
            // Generamos el token
            $token = createJWT(array(
                'sub' => $user->id_usuario,
                'email' => $user->email,
                'role' => 'admin',
                'iat' => time(),
                'exp' => time() + 60,
                'Saludo' => 'Hola',
            ));
            return $this->view->response($token);
        }
    }
