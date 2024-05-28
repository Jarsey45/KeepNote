<?php
declare(strict_types=1);

require_once './config.php';
require_once './Router.php';

$router = new Router();



// $controller = new AppController();

// $path = trim($_SERVER['REQUEST_URI'], '/');
// $path = parse_url( , PHP_URL_PATH);
// $action = explode('/', $path)[0];
// $action = $action == null ? 'login' : $action;

// $controller->render($action, ['subpage' => $_GET['subpage'] ?? '']);

$router->dispatch($_SERVER['REQUEST_URI']);