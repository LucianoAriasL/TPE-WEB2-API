<?php
require_once 'libs/Router.php';
require_once 'app/controllers/ZapatillasApiController.php';

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('zapatillas','GET','ZapatillasApiController','getSneakers');
$router->addRoute('zapatillas/:ID','GET','ZapatillasApiController','getSneaker');
$router->addRoute('zapatillas/:ID','DELETE','ZapatillasApiController','deleteSneaker');
$router->addRoute('zapatillas','POST','ZapatillasApiController','addSneaker');

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);