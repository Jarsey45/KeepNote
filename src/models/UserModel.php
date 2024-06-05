<?php

require_once './src/enums/Roles.php';
require_once CLASSES_PATH . 'User.php';
require_once MODELS_PATH . 'AbstractModel.php';

class UserModel extends Model {

  protected string $tableName = 'kn_users';

  protected function castToClass(array $data) : array {
    $resultArray = [];

    foreach($data as $el) {
      $resultArray[] = new User(
        $el['id'], 
        $el['username'], 
        $el['password'], 
        $el['email'], 
        Roles::from($el['id_role']), 
        $el['date_created']
      );
    }

    return $resultArray;
  }
}