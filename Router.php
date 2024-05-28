<?php 

require_once CONTROLLERS_PATH . 'AppController.php';
require_once CONTROLLERS_PATH . 'NotesController.php';

class Router {
	private array $routes = [];

	function __construct() {
		$this->addRoute('/', new AppController());
		$this->addRoute('/dashboard', new NotesController());
		$this->addRoute('/register', new AppController());
		$this->addRoute('/login', new AppController());
	}

	public function addRoute(string $pattern, Controller $controller) : void {
		$this->routes[$pattern] = $controller;
	}

	public function dispatch(string $uri) : void {
		foreach($this->routes as $pattern => $controller) {
			$path = parse_url($uri, PHP_URL_PATH);
			if($pattern === $path) {
				parse_str(parse_url($uri, PHP_URL_QUERY) ?? '', $params);
				$controller->render($pattern, $params);
				return;
			}
		}

		$fallbackController = new AppController();
		$fallbackController->render('/404');
	}
}