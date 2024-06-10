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

  //TODO: html content sanitization
  public function getUsername() { return $this->username; }

  public function getPassword() { return $this->password; }

  public function getEmail() { return $this->email; }

  public function getRole() { return $this->role; }

  //TODO: html content sanitization
  public function getDateCreated() { 
    try {
      $dateObj = new DateTime($this->date_created);
      return $dateObj->format('d M Y');
    } catch (Exception $e) {
      return $this->date_created;
    }
  }
}