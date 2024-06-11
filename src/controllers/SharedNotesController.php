<?php
require_once './src/enums/Subpages.php';
require_once './src/utils.php';
require_once MODELS_PATH . 'SharedNoteModel.php';

class SharedNotesController extends AppController {

	public function __construct() {
		$this->model = new SharedNoteModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		$variables['shared_notes'] = $this->getSharedNotes();
		$variables['subpage'] = Subpages::SHARED_NOTES->value;
		$this->render('/dashboard', $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function getSharedNotes() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) 
			return $this->model->find(['id_shared_user' => (int) $_SESSION['user_id']]);
		return [];
	}
}