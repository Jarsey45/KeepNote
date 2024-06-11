<?php

require_once CLASSES_PATH . 'IClassObject.php';
require_once CLASSES_PATH . 'AbstractClassObject.php';

class Note extends AbstractClassObject implements IClassObject {

	#[PersistableProperty(true)]
	private int $id_owner;

	#[PersistableProperty(true)]
	private string $title;

	#[PersistableProperty(true)]
	private string $content;

	#[PersistableProperty(true)]
	private string $color;

	private string $date_created;

	public function __construct(int $id) {
		$this->id = $id;
	}

	public function setOwner(int $owner) : self {
		$this->id_owner = $owner;
		return $this;
	}

	public function setTitle(string $title) : self {
		$this->title = $title;
		return $this;
	}

	public function setContent(string $content) : self {
		$this->content = $content;
		return $this;
	}

	public function setColor(string $color) : self {
		$this->color = $color;
		return $this;
	}

	public function setDateCreated(string $dateCreated) : self {
		$this->date_created = $dateCreated;
		return $this;
	}

	public function getId() : int { return $this->id; }

	public function getOwner() : int { return $this->owner; }

	//TODO: html content sanitization
	public function getTitle() : string { return $this->title; }

	//TODO: html content sanitization
	public function getContent() : string { return $this->content; }

	//TODO: html content sanitization
	public function getColor() : string { return $this->color; }

	//TODO: html content sanitization
	public function getDateCreated() : string { 
		try {
			$dateObj = new DateTime($this->date_created);
			return $dateObj->format('d M Y');
		} catch (Exception $e) {
			return $this->date_created;
		}
	}

	public function getDBQueryBindings(): array
	{
		return parent::getDBQueryBindings();
	}
}