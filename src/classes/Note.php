<?php

require_once CLASSES_PATH . 'IClassObject.php';
require_once CLASSES_PATH . 'AbstractClassObject.php';

class Note extends AbstractClassObject implements IClassObject {
  private int $owner;
  private string $title;
  private string $content;
  private string $color;
  private string $date_created;

  public function __construct(int $id, int $owner, string $title, string $content, string $color, string $date_created) {
    $this->id = $id;
    $this->owner = $owner;
    $this->title = $title;
    $this->content = $content;
    $this->color = $color;
    $this->date_created = $date_created;
  }

  public function getId() : int { return $this->id; }

  public function getOwner() : int { return $this->owner; }

  public function getTitle() : string { return $this->title; }

  public function getContent() : string { return $this->content; }

  public function getColor() : string { return $this->color; }

  public function getDateCreated() : string { return $this->date_created; }
}