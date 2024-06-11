<?php

require_once CLASSES_PATH . 'Note.php';
require_once MODELS_PATH . 'AbstractModel.php';

class NoteModel extends Model {

	protected string $tableName = 'kn_notes';

	protected function castToClass(array $data) : array {
		$resultArray = [];

		foreach($data as $el) {
			$resultArray[] = (new Note($el['id']))
				->setOwner($el['id_owner'])
				->setTitle($el['title'])
				->setContent($el['content'])
				->setColor($el['color'])
				->setDateCreated($el['date_created']);
		}

		return $resultArray;
	}

	public function isUserOwner(int $id, int $user_id) : bool {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$conditions = ['id' => $id, 'id_owner' => $user_id];

		$whereClause = $this->createPreparedWhereClause($conditions);

		$sql = <<<QUERY
			SELECT EXISTS (SELECT 1 FROM {$this->tableName} WHERE $whereClause)
		QUERY;

		$stmt = $conn->prepare($sql); //TODO: throw exception
		$stmt->execute($conditions);

		return $stmt->fetchColumn();
	}
	

	protected function getUpdateStatement() : string {
		return <<<STMT
			title = :title, content = :content
		STMT;
	}

	protected function getInsertStatement() : string {
		return <<<STMT
			(id_owner, title, content, color, date_created)
			VALUES (:id_owner, :title, :content, :color, Now());
		STMT;
	}
}