<?php 

require_once CONTROLLERS_PATH . 'AppController.php';
require_once CONTROLLERS_PATH . 'NotesController.php';
require_once CONTROLLERS_PATH . 'SharedNotesController.php';
require_once CONTROLLERS_PATH . 'AccountController.php';
require_once CONTROLLERS_PATH . 'AuthController.php';

class Router {
	private array $routes = [];

	function __construct() {
		$this->addRoute('/', new AppController());
		$this->addRoute('/' . Subpages::NOTES->value, new NotesController());
		$this->addRoute('/' . Subpages::SHARED_NOTES->value, new SharedNotesController());
		$this->addRoute('/' . Subpages::ACCOUNT_USER->value, new AccountController());
		$this->addRoute('/register', new AuthController());
		$this->addRoute('/login', new AuthController());
	}

	public function addRoute(string $pattern, Controller $controller) : void {
		$this->routes[$pattern] = $controller;
	}

	public function dispatch(string $uri) : void {
		foreach($this->routes as $pattern => $controller) {
			$path = parse_url($uri, PHP_URL_PATH);
			$path = $path === '/' ? '/notes' : $path;
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