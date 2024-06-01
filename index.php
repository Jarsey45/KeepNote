<?php
declare(strict_types=1);

require_once './config.php';
require_once './Router.php';

$router = new Router();

$router->dispatch($_SERVER['REQUEST_URI']);