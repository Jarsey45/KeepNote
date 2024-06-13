<?php

namespace App;

require_once CLASSES_PATH . 'IDatabasePersistable.php';

#[\Attribute]
class PersistableProperty {
	public function __construct(public bool $includeInInsertBindings = false, public bool $includeInUpdateBindings = false) {}
}

abstract class AbstractClassObject implements IDatabasePersistable {

	#[PersistableProperty(false, true)]
	protected int $id;

	public function getId() : int { return $this->id; }

	public function getDBInsertBindings() : array {
		$reflection = new \ReflectionClass($this);
		//Added ReflectionProperty::IS_PROTECTED to allow getting properties from base class in derived classes
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

		$bindings = [];
		foreach ($properties as $prop) {
			$propName = $prop->getName();
			$prop->setAccessible(true);

			$annotation = $prop->getAttributes(PersistableProperty::class)[0] ?? null;

			if ($annotation && $annotation->newInstance()->includeInInsertBindings) {
				$val = $prop->getValue($this);
				$bindings[":$propName"] = $val instanceof Roles ? $val->value : $val;
			}

			$prop->setAccessible(false);
		}

		return $bindings;
	}

	public function getDBUpdateBindings() : array {
		$reflection = new \ReflectionClass($this);
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED);

		$bindings = [];
		foreach ($properties as $prop) {
			$propName = $prop->getName();
			$prop->setAccessible(true);

			$annotation = $prop->getAttributes(PersistableProperty::class)[0] ?? null;

			if ($annotation && $annotation->newInstance()->includeInUpdateBindings) {
				$val = $prop->getValue($this);
				$bindings[":$propName"] = $val instanceof Roles ? $val->value : $val;
			}

			$prop->setAccessible(false);
		}

		return $bindings;
	}
}