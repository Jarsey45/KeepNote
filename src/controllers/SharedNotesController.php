<?php
require_once './src/enums/Subpages.php';
require_once './src/utils.php';
require_once CLASSES_PATH . 'SharedNote.php';
require_once MODELS_PATH . 'SharedNoteModel.php';

class SharedNotesController extends AppController {

	public function __construct() {
		$this->model = new SharedNoteModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		if($this->isPost()) return $this->handlePost();

		$variables['shared_notes'] = $this->getSharedNotes();
		$variables['subpage'] = Subpages::SHARED_NOTES->value;
		$this->render('/dashboard', $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function handlePost() {
		$request = $this->parseJSONRequest();

		//TODO: handle ::from() exception
		$action = isset($request['action']) ? PostActions::from($request['action']) : PostActions::NONE;
		$data = $request['data'];
		$headers = [];
		
		switch($action) {
			case PostActions::SHARE:
				$response = $this->shareNote($data);
				break;
			default:
				$response = "No action available"; //TODO: send some header
				break;
		}
		
		$this->sendResponse($response, $headers); //TODO: better response from server
	}

	private function getSharedNotes() {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) 
			return $this->model->find(['id_shared_user' => (int) $_SESSION['user_id']]);
		return [];
	}

	private function shareNote($data) : bool {
		$sharedNote = (new SharedNote(-1))
			->setIdNote($data['id'])
			->setEmail($data['email']);
		return $this->model->insert($sharedNote);
	}
}