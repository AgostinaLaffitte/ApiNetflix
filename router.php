<?php

require_once './Libs/response.php';
require_once './Libs/route.php';
require_once './App/Middlewares/session.auth.middleware.php';
require_once './App/Controllers/film.controller.php';
require_once './App/Controllers/producer.controller.php';
require_once './App/Controllers/auth.controller.php';
require_once './App/Middlewares/jwt.auth.middleware.php';
require_once './config/config.php';


// base_url para direcciones y base tag
define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$router = new Router();
$router->addMiddleware(new JWTAuthMiddleware());

$router->addRoute('peliculas', 'GET', 'FilmsController', 'showHome');
$router->addRoute('peliculas/:id', 'GET', 'FilmsController', 'showFilmDetails');
$router->addRoute('peliculas', 'POST', 'FilmsController', 'addFilm');
$router->addRoute('peliculas/:id', 'DELETE', 'FilmsController', 'deleteFilm');
$router->addRoute('peliculas/:id', 'PUT', 'FilmsController', 'editFilm');

$router->addRoute('productoras', 'GET', 'producerController', 'showProducers');
$router->addRoute('productoras/:id', 'GET', 'producerController', 'seeProducer');
$router->addRoute('productoras', 'POST', 'producerController', 'addProducer');
$router->addRoute('productoras/:id', 'DELETE', 'producerController', 'deleteProducer');
$router->addRoute('productoras/:id', 'PUT', 'producerController', 'modifyProducers');

$router->addRoute('usuarios/token', 'GET','UserApiController','getToken');
$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);

// PD: Hagamos las url semanticas en Español, Asi queda mas lindo
// ej TPE-WEB/peliculas

//switch ($params[0]) {

  //  case 'inicio':
  //    sessionAuthMiddleware($res);
  //     $controller = new FilmsController($res);
  //    $controller->showHome();
  //    break;

   // case 'agregar':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //     $controller = new AdminController($res);
    //     $controller->showFilms();
    //     break;

    //  case 'nueva';
    // sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->addFilm();
    //    break;

    // case 'eliminar':
    //     sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->deleteFilm($params[1]);
    //    break;

    //case 'editar':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //   $controller = new AdminController($res);
    //    $controller->editFilm($params[1]);
    //    break;

   // Nuevo caso para mostrar detalles de la película
    //case 'pelicula':
    //    sessionAuthMiddleware($res);
    //    $controller = new FilmsController($res);
    //    $controller->showFilmDetails($params[1]); // Llamamos al nuevo método
    //    break;


    //case 'productora':
    //    sessionAuthMiddleware($res);
    //    $controller = new producerController($res);
    //    $controller->showProducers();
    //    break;

    //case 'verProductora':
    //    sessionAuthMiddleware($res);
    //   $controller = new producerController($res);
    //    $controller->seeProducer($params[1]);
    //    break;

  //  case 'showLogin':
   //     $controller = new AuthController();
    //    $controller->showLogin();
    //    break;
    //case 'login':
    //    $controller = new AuthController();
    //    $controller->login();
    //    break;
    //case 'logout':
    //    $controller = new AuthController();
    //    $controller->logout();
    //    break;


    //case 'agregarProductora':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->addProducer();
    //    break;

   // case 'productoraAgregada':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->addedProducer();
    //    break;

    //case 'eliminarProductora':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->deleteProducer($params[1]);
    //    break;

    //case 'editarProductora':
    //    sessionAuthMiddleware($res);
    //    verifyAuthMiddleware($res); 
    //    $controller = new AdminController($res);
    //    $controller->modifyProducers($params[1]);
    //    break;

    //case 'verDetalle':
    //  sessionAuthMiddleware($res);
    //    $controller = new producerController($res);
    //    $controller->seeDetail($params[1]);
    //    break;
    //default:
    //   echo "404 Page Not Found";
    //    break;
//}
