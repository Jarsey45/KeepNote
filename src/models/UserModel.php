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

	protected function getUpdateStatement() : string {
		return <<<STMT
			username = :username, email = :email, password = :password, id_role = :id_role, date_created = :date_created
		STMT;
	}

	protected function getInsertStatement() : string {
		return <<<STMT
			(username, email, password, id_role, date_created)
			VALUES (:username, :email, :password, :id_role, :date_created)
		STMT;
	}
}