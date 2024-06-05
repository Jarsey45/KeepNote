<?php 

require_once CONTROLLERS_PATH . 'AppController.php';
require_once CONTROLLERS_PATH . 'NotesController.php';
require_once CONTROLLERS_PATH . 'AccountController.php';

class Router {
	private array $routes = [];

	function __construct() {
		$this->addRoute('/', new AppController());
		$this->addRoute('/dashboard', new NotesController());
		$this->addRoute('/register', new AccountController());
		$this->addRoute('/login', new AccountController());
	}

	public function addRoute(string $pattern, Controller $controller) : void {
		$this->routes[$pattern] = $controller;
	}

	public function dispatch(string $uri) : void {
		foreach($this->routes as $pattern => $controller) {
			$path = parse_url($uri, PHP_URL_PATH);
			$path = $path === '/' ? '/dashboard' : $path;
			if($pattern === $path) {
				parse_str(parse_url($uri, PHP_URL_QUERY) ?? '', $params);
				$handler = explode('/', $path)[1];
				$controller->handle($handler, $pattern, $params);
				return;
			}
		}

		$fallbackController = new AppController();
		$fallbackController->render('/404');
	}
}