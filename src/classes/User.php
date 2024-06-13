<?php 

namespace App;

require_once CLASSES_PATH . 'IClassObject.php';
require_once CLASSES_PATH . 'AbstractClassObject.php';

class User extends AbstractClassObject implements IClassObject {

	#[PersistableProperty(true, true)]
	private string $username;

	#[PersistableProperty(true)]
	private string $password;

	#[PersistableProperty(true)]
	private string $email;

	#[PersistableProperty(true)]
	private Roles $role;

	private string $date_created;

	public function __construct(int $id) {
		$this->id = $id;
	}

	public function setUsername(string $username) : self {
		$this->username = $username;
		return $this;
	}

	public function setPassword(string $password) : self {
		$this->password = $password;
		return $this;
	}

	public function setEmail(string $email) : self {
		$this->email = $email;
		return $this;
	}

	public function setRole(Roles $role) : self {
		$this->role = $role;
		return $this;
	}

	public function setDateCreated(string $date_created) : self {
		$this->date_created = $date_created;
		return $this;
	}

	//TODO: html content sanitization
	public function getUsername() { return $this->username; }

	public function getPassword() { return $this->password; }

	public function getEmail() { return $this->email; }

	public function getRole() { return $this->role; }

	//TODO: html content sanitization
	public function getDateCreated() { 
		try {
			$dateObj = new \DateTime($this->date_created);
			return $dateObj->format('d M Y');
		} catch (\Exception $e) {
			return $this->date_created;
		}
	}
}