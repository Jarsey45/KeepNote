<?php
require_once CONTROLLERS_PATH . 'IController.php';

class AppController implements Controller {

	protected Model $model; 

	protected function isLoggedIn() : bool {
		session_start();

		if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) return true;
		
		print $this->getTemplateData('not_logged_in', []);
		return false;
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		$this->render($template, $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	protected function getTemplateData(string $templateName, array $variables) {
		$templatePath = VIEWS_PATH . $templateName . '.php';
		$notFoundPath = VIEWS_PATH . '404.php';

		try {

			ob_start();
			include $notFoundPath;
			$output = ob_get_clean();

			if(file_exists($templatePath)) {
				extract($variables);

				ob_start();
				include $templatePath;
				$output = ob_get_clean();
			}
			
			if($output === false) throw new Exception("Could not load template file");
			
			return $output;
		} catch (\Exception $e) {
			print($e->getMessage());
		}
	}

	protected function isPost() : bool { return $_SERVER['REQUEST_METHOD'] == 'POST'; }
	protected function isGet() : bool { return $_SERVER['REQUEST_METHOD'] == 'GET'; }
}