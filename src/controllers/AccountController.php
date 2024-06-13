<?php

namespace App;

require_once './src/enums/Subpages.php';
require_once './src/utils.php';
require_once MODELS_PATH . 'NoteModel.php';

class AccountController extends AppController {

	public function __construct() {
		$this->model = new UserModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		if(!$this->isLoggedIn()) return;
		if($this->isPost()) return $this->handlePost();

		$subpage = $_SESSION['user_role'] === Roles::ADMIN ? (Subpages::from($handler) ?? Subpages::ACCOUNT_USER) : Subpages::ACCOUNT_USER;
		$variables['subpage'] = $subpage->value;
		
		switch($subpage) {
			case Subpages::ACCOUNT_ADMIN:
				$variables['users'] = $this->getAccounts();
				break;
			case Subpages::ACCOUNT_USER:
				$variables['user'] = $this->getAccountInfo();
				break;
			default: break;
		}

		$this->render('/dashboard', $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function handlePost() {
		$request = $this->parseJSONRequest();

		$action = isset($request['action']) ? PostActions::from($request['action']) : PostActions::NONE;
		$data = $request['data'];
		$headers = [];
		
		switch($action) {
			case PostActions::DELETE:
				$response = $this->deleteAccount($data);
				break;
			case PostActions::LOG_OUT:
				session_destroy();
				$response = true;
				break;
			default:
				$response = "No action available"; //TODO: send some header
				break;
		}
		
		$this->sendResponse($response, $headers); //TODO: better response from server
	}

	private function getAccountInfo() : User|null {
		if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
			$user = $this->model->find(['id' => (int) $_SESSION['user_id']]);
			if($user[0] instanceof User)
				return $user[0];
		}
		return null;
	}

	private function getAccounts() : array {
		$users = $this->model->findAll();
		return !empty($users) ? $users : [];
	}

	private function deleteAccount($data) : bool {
		if (!isset($data['id']))
			return false;
		return $this->model->delete((int) $data['id']);
	}
}