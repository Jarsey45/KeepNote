<?php
require_once './src/enums/Subpages.php';
require_once './src/utils.php';

class NotesController extends AppController {
  public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output; 
	}

  private function getNotesForUser() {

  }
}