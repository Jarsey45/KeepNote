<?php

class AppController {
	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template);
		print $output;
	}

	private function getTemplateData(string $templateName) {
		$templatePath = 'public/views/' . $templateName . '.php';
		$notFoundPath = 'public/views/404.html';

		try {

			ob_start();
			include $notFoundPath;
			$output = ob_get_clean();

			if(file_exists($templatePath)) {
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
}