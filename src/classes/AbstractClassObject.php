<?php

require_once CLASSES_PATH . 'IDatabasePersistable.php';

#[Attribute]
class PersistableProperty {
  public function __construct(public bool $includeInBindings = false) {}
}

abstract class AbstractClassObject implements IDatabasePersistable {

  #[PersistableProperty(true)]
  protected int $id;

  public function getId() : int { return $this->id; }

  public function getDBQueryBindings() : array {
    $reflection = new ReflectionClass($this);
    $properties = $reflection->getProperties(ReflectionProperty::IS_PRIVATE);

    $bindings = [];
    foreach ($properties as $prop) {
      $propName = $prop->getName();
      $prop->setAccessible(true);

      $annotation = $prop->getAttributes(PersistableProperty::class)[0] ?? null;

      if ($annotation && $annotation->newInstance()->includeInBindings) {
        $bindings[":$propName"] = $prop->getValue($this);
      }

      $prop->setAccessible(false);
    }

    return $bindings;
  }
}