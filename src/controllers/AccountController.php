<?php 

require_once './src/enums/Pages.php';
require_once MODELS_PATH . 'UserModel.php';

class AccountController extends AppController {

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

    $user = $this->model->findOne(['email' => $email])[0];
    if(!$user) return;

    session_start();
    $_SESSION['logged_in'] = true;

    header("Location: http://{$_SERVER['HTTP_HOST']}/dashboard");
    die();
  }

  private function register() {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];



    header("Location: http://{$_SERVER['HTTP_HOST']}/dashboard");
    die();
  }
}