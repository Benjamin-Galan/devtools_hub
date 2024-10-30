<?php



require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\LoginController;
use Controllers\PagesController;
use Controllers\CategoryController;
use MVC\Router;
use Controllers\ToolController;

$router = new Router();

//zona publica
$router->get('/', [PagesController::class, 'index']);
$router->get('/elements', [PagesController::class, 'elements']);

//zona privada
$router->get('/admin', [ToolController::class, 'index']);
$router->get('/tools/create', [ToolController::class, 'create']);
$router->post('/tools/create', [ToolController::class, 'create']);
$router->get('/tools/update', [ToolController::class, 'update']);
$router->post('/tools/update', [ToolController::class, 'update']);
$router->post('/tools/delete', [ToolController::class, 'delete']);

$router->get('/categories/create', [CategoryController::class, 'create']);
$router->post('/categories/create', [CategoryController::class, 'create']);
$router->get('/categories/update', [CategoryController::class, 'update']);
$router->post('/categories/update', [CategoryController::class, 'update']);
$router->post('/categories/delete', [CategoryController::class, 'delete']);

//login y autenticacion
$router->get('/login', [LoginController::class, 'login'] );
$router->post('/login', [LoginController::class, 'login'] );
$router->get('/logout', [LoginController::class, 'logout'] );

//api de herramientas
$router->get('/api/tools', [APIController::class, 'tool']);
$router->get('/api/category', [APIController::class, 'category']);

$router->comprobarRutas();