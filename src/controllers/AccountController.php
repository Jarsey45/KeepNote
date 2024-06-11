<?php
require_once './src/enums/Subpages.php';
require_once './src/utils.php';
require_once MODELS_PATH . 'NoteModel.php';

class AccountController extends AppController {

	public function __construct() {
		$this->model = new NoteModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		$variables['subpage'] = Subpages::ACCOUNT_USER->value;
		$this->render('/dashboard', $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function account() {

	}
}