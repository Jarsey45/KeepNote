<?php

require_once './src/utils.php';
require_once DB_PATH . 'DatabaseClientFactory.php';

abstract class Model {
  protected string $tableName;

  public function __construct() {}

  abstract protected function castToClass(array $data);

  public function update(int $id, IClassObject $data) : bool {

    // if(!$this->validate($data)) return false;

    $sql = <<<UPDATE_QUERY
      UPDATE {$this->tableName}
    UPDATE_QUERY;
    return true;
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

    $whereClause = createPreparedWhereClause($conditions);

    $sql = <<<QUERY
      SELECT *
      FROM {$this->tableName}
      WHERE $whereClause
    QUERY;

    $stmt = $conn->prepare($sql); //TODO: throw exception
    $stmt->execute($conditions);

    return $this->castToClass($stmt->fetchAll(PDO::FETCH_ASSOC));
  }
}