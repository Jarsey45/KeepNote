<?php

require_once CLASSES_PATH . 'IDatabasePersistable.php';

class AbstractClassObject implements IDatabasePersistable {

  protected int $id;

  public function getId() : int { return $this->id; }

  public function getDBQueryBindings() : array {
    $reflection = new ReflectionClass($this);
    $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

    $bindings = [];
    foreach($properties as $prop) {
      $propName = $prop->getName();
      $bindings[":$propName"] = $this->{$propName};
    }

    return $bindings;
  }
}