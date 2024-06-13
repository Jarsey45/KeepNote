<?php

require_once CLASSES_PATH . 'IClassObject.php';
require_once CLASSES_PATH . 'AbstractClassObject.php';

class SharedNote extends AbstractClassObject implements IClassObject {

	#[PersistableProperty(true)]
	private int $id_note;

	#[PersistableProperty(true)]
	private int $id_shared_user;

	private string $email;

	public function __construct(int $id) {
		$this->id = $id;
	}

	public function setIdNote(int $id_note) : self {
		$this->id_note = $id_note;
		return $this;
	}

	public function setIdSharedUser(int $id_shared_user) : self {
		$this->id_shared_user = $id_shared_user;
		return $this;
	}

	public function setEmail(string $email) : self { //TODO: feels wrong xd
		$this->email = $email;
		return $this;
	}

	public function getIdNote() : int { return $this->id_note; }
	public function getIdSharedUser() : int { return $this->id_shared_user; }
	public function getEmail() : string { return $this->email; }
}