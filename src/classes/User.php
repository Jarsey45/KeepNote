<?php 

require_once CLASSES_PATH . 'IClassObject.php';

class User implements IClassObject {
  private int $id;
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

  public function getId() : int { return $this->id; }
}