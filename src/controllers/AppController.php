<?php

class AppController {
	public function render(string $template = null, array $variables = []) {
		$templatePath = 'public/views/' . $template . '.html';
		$output = 'File not found'; //TODO: dorobić 404.html

		if (file_exists($templatePath)) {
			extract($variables);

			ob_start();
			include $templatePath;
			$output = ob_get_clean();
		}

		print $output;
	}
}