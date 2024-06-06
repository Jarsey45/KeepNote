<?php 

require_once CLASSES_PATH . 'IClassObject.php';
require_once CLASSES_PATH . 'AbstractClassObject.php';

class User extends AbstractClassObject implements IClassObject {
  private string $username;
  private string $password;
  private string $email;
  private Roles $role;
  private string $date_created;

  public function __construct(int $id, string $username, string $password, string $email, Roles $role, string $date_created) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password;
    $this->email = $email;
    $this->role = $role;
    $this->date_created = $date_created;
  }

  public function getUsername() { return $this->username; }

  public function getPassword() { return $this->password; }

  public function getEmail() { return $this->email; }

  public function getRole() { return $this->role; }

  public function getDateCreated() { return $this->date_created; }
}