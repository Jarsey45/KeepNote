<?php

namespace App;

require_once './src/enums/Roles.php';
require_once CLASSES_PATH . 'User.php';
require_once MODELS_PATH . 'AbstractModel.php';

class UserModel extends Model {

	protected string $tableName = 'kn_users';

	protected function castToClass(array $data) : array {
		$resultArray = [];

		foreach($data as $el) {
			$resultArray[] = (new User($el['id']))
				->setUsername($el['username'])
				->setPassword($el['password'])
				->setEmail($el['email'])
				->setRole(Roles::from($el['id_role']))
				->setDateCreated($el['date_created']);
		}

		return $resultArray;
	}

	//TODO: cascade delete notes for user #[Override]

	protected function getUpdateStatement() : string {
		return <<<STMT
			username = :username, email = :email, password = :password
		STMT;
	}

	protected function getInsertStatement() : string {
		return <<<STMT
			(username, email, password, id_role)
			VALUES (:username, :email, :password, :role)
		STMT;
	}
}