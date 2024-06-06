<?php
require_once './src/enums/Subpages.php';
require_once './src/utils.php';
require_once MODELS_PATH . 'NoteModel.php';

class NotesController extends AppController {

  public function __construct() {
    $this->model = new NoteModel();
  }

  public function handle(string $handler, string &$template = null, array &$variables = []) {
    if(!$this->isLoggedIn()) return;
    $variables['notes'] = $this->model->findAll();


		$this->render($template, $variables);
	}

  public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

  private function notes() {

  }

  private function sharedNotes() {

  }

  private function account() {

  }
}