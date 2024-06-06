<?php

require_once DB_PATH . 'DatabaseClientFactory.php';

abstract class Model {
  protected string $tableName;

  public function __construct() {}

  abstract protected function castToClass(array $data) : array;
  abstract protected function getUpdateStatement() : string;
  abstract protected function getInsertStatement() : string;

  public function update(int $id, IDatabasePersistable $data) : bool { 
    $conn = DatabaseClientFactory::getFactory()->getConnection();

    $sql = <<<QUERY
      UPDATE {$this->tableName}
      SET {$this->getUpdateStatement()}
      WHERE id = :id
    QUERY;

    $stmt = $conn->prepare($sql);
    return $stmt->execute($data->getDBQueryBindings());
  }

  public function insert(int $id, IDatabasePersistable $data) : bool {
    $conn = DatabaseClientFactory::getFactory()->getConnection();

    $sql = <<<QUERY
      INSERT INTO {$this->tableName}
      {$this->getInsertStatement()}
    QUERY;

    $stmt = $conn->prepare($sql);
    return $stmt->execute($data->getDBQueryBindings());
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

  public function findOne(array $conditions) : array {
    $conn = DatabaseClientFactory::getFactory()->getConnection();

    $whereClause = $this->createPreparedWhereClause($conditions);

    $sql = <<<QUERY
      SELECT *
      FROM {$this->tableName}
      WHERE $whereClause
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


  private function createPreparedWhereClause(array $conditions): string {
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