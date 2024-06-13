<?php

require_once DB_PATH . 'DatabaseClientFactory.php';

abstract class Model {
	protected string $tableName;

	public function __construct() {}

	abstract protected function castToClass(array $data) : array;
	abstract protected function getUpdateStatement() : string;
	abstract protected function getInsertStatement() : string;

	public function update(IDatabasePersistable $data) : bool { 
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			UPDATE {$this->tableName}
			SET {$this->getUpdateStatement()}
			WHERE id = :id
		QUERY;

		$stmt = $conn->prepare($sql);
		return $stmt->execute($data->getDBUpdateBindings());
	}

	public function insert(IDatabasePersistable $data) : bool {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			INSERT INTO {$this->tableName}
			{$this->getInsertStatement()}
		QUERY;

		$stmt = $conn->prepare($sql);
		return $stmt->execute($data->getDBInsertBindings());
	}

	// protected function validate(IClassObject $data) : bool {}

	public function findAll() : array {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			SELECT *
			FROM {$this->tableName}
		QUERY;

		$stmt = $conn->query($sql); //TODO: throw exception

		return $this->castToClass($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

	public function find(array $conditions, string $orderBy = '') : array {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$whereClause = $this->createPreparedWhereClause($conditions);
		$orderBy = !empty($orderBy) ? "ORDER BY $orderBy DESC" : '';

		$sql = <<<QUERY
			SELECT *
			FROM {$this->tableName}
			WHERE $whereClause
			$orderBy
		QUERY;

		$stmt = $conn->prepare($sql); //TODO: throw exception
		$stmt->execute($conditions);

		return $this->castToClass($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

	public function delete(int $id) : bool {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			 DELETE FROM {$this->tableName}
			 WHERE id = :id
		QUERY;

			$stmt = $conn->prepare($sql);
			$stmt->bindValue(':id', $id, PDO::PARAM_INT);

			return $stmt->execute();
	}

	public function exists(array $conditions) : bool {
		return !empty($this->find($conditions));
	}

	protected function createPreparedWhereClause(array $conditions): string {
		if (empty($conditions)) {
			return '1=1';
		}
	
		$placeholders = [];
		$whereClauses = [];
		foreach ($conditions as $field => $value) {
			$placeholder = ":" . $field;
			$placeholders[] = $placeholder;
			$whereClauses[] = "$field = $placeholder";
		}
	
		return implode(' AND ', $whereClauses);
	}
}