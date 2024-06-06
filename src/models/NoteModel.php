<?php

require_once CLASSES_PATH . 'Note.php';
require_once MODELS_PATH . 'AbstractModel.php';

class NoteModel extends Model {

  protected string $tableName = 'kn_notes';

  protected function castToClass(array $data) : array {
    $resultArray = [];

    foreach($data as $el) {
      $resultArray[] = new Note(
        $el['id'], 
        $el['id_owner'],
        $el['title'],
        $el['content'],
        $el['color'],
        $el['date_created']
      );
    }

    return $resultArray;
  }
  

  protected function getUpdateStatement() : string {
    return <<<STMT
      id_owner = :id_owner, title = :title, content = :content, color = :color, date_created = :date_created
    STMT;
  }

  protected function getInsertStatement() : string {
    return <<<STMT
      (id_owner, title, content, color, date_created)
      VALUES (:id_owner, :title, :content, :color, :date_created);
    STMT;
  }
}