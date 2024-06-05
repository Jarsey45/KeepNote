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
  
}