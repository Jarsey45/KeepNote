<?php
require_once './src/enums/Subpages.php';
require_once './src/enums/PostActions.php';
require_once './src/utils.php';
require_once MODELS_PATH . 'NoteModel.php';

class NotesController extends AppController {

	public function __construct() {
		$this->model = new NoteModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		if($this->isPost()) return $this->handlePost();


		$variables['subpage'] = Subpages::NOTES->value;
		$variables['notes'] = $this->getNotes();
		$this->render('/dashboard', $variables);
	}

	private function handlePost() {
		$request = $this->parseJSONRequest();

		$action = isset($request['action']) ? PostActions::from($request['action']) : PostActions::NONE;
		$data = $request['data'];
		$headers = [];
		
		switch($action) {
			case PostActions::INSERT:
				$response = $this->insertNote($data);
				break;
			case PostActions::DELETE:
				$response = $this->deleteNote($data);
				break;
			case PostActions::UPDATE:
				$response = $this->updateNote($data);
				break;
			default:
				$response = "No action available"; //TODO: send some header
				break;
		}
		
		$this->sendResponse($response, $headers); //TODO: better response from server
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function getNotes() : array {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) 
			return $this->model->find(['id_owner' => (int) $_SESSION['user_id']]);
		return [];
	}

	private function deleteNote($data) : bool {
		if (!isset($data['id']) || !$this->model->isUserOwner($data['id'], $_SESSION['user_id']))
			return false;
		return $this->model->delete((int) $data['id']);
	}

	private function updateNote($data) : bool {
		$updatedNote = (new Note($data['id']))
			->setTitle($data['title'])
			->setContent($data['content']);
		return $this->model->update($updatedNote);
	}

	private function insertNote($data) : bool {
		$newNote = (new Note(-1))
			->setOwner($_SESSION['user_id'])
			->setTitle($data['title'])
			->setContent($data['content'])
			->setColor(getRandomPastelColor());
		return $this->model->insert($newNote);
	}
}