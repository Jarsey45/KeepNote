<?php 

namespace App;

require_once './src/enums/Pages.php';
require_once MODELS_PATH . 'UserModel.php';

class AuthController extends AppController {

	public function __construct() {
		$this->model = new UserModel();
	}

	public function handle(string $handler, string &$template = null, array &$variables = []) {
		$handler = isset($handler) ? Pages::from($handler) : Pages::LOGIN;
		switch($handler) {
			case Pages::LOGIN:
				if(!$this->isPost() || empty($_POST)) break;
				
				$this->login();
				break;
			case Pages::REGISTER:
				if(!$this->isPost() || empty($_POST)) break;
				
				$this->register();
				break;
		}

		$this->render($template, $variables);
	}

	public function render(string $template = null, array $variables = []) {
		$output = $this->getTemplateData($template, $variables);
		print $output;
	}

	private function login() {
		$email = $_POST['email'];
		$password = $_POST['password'];

		$user = $this->model->find(['email' => $email]);
		$user = empty($user) ? [] : $user[0];
		if(!$user) {
			$this->render(Pages::LOGIN->value, ['messages' => ['User not found!']]);
			die();
		}

		if($user->getPassword() !== $password) { // TODO: should not work like this, placeholder
			$this->render(Pages::LOGIN->value, ['messages' => ['Wrong password!']]);
			die();
		}

		session_start();
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $user->getId();
		$_SESSION['user_role'] = $user->getRole();

		header("Location: http://{$_SERVER['HTTP_HOST']}/" . Subpages::NOTES->value);
		die();
	}

	private function register() {
		$email = $_POST['email'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirm_password'];

		if($password !== $confirm_password) {
			$this->render(Pages::REGISTER->value, ['messages' => ['Passwords are not the same!']]);
			die();
		}

		$userExists = $this->model->find(['email' => $email]);

		if(!empty($userExists)) {
			$this->render(Pages::REGISTER->value, ['messages' => ['User with email already exists']]);
			die();
		}

		$username = explode('@', $email)[0];

		$newUser = (new User(-1))
			->setUsername($username)
			->setEmail($email)
			->setRole(Roles::USER)
			->setPassword($password);

		$isInserted = $this->model->insert($newUser);

		if(!$isInserted) {
			$this->render(Pages::REGISTER->value, ['messages' => ['Could not create new user']]);
			die();
		}

		$insertedUser = $this->model->find(['email' => $email]);
	
		if(empty($insertedUser) || !($insertedUser[0] instanceof User)) {
			$this->render(Pages::LOGIN->value, ['messages' => ['Could not login in, try again!']]);
			die();
		}

		$user = $insertedUser[0];

		session_start();
		$_SESSION['logged_in'] = true;
		$_SESSION['user_id'] = $user->getId();
		$_SESSION['user_role'] = $user->getRole();

		header("Location: http://{$_SERVER['HTTP_HOST']}/" . Subpages::NOTES->value);
		die();
	}
}