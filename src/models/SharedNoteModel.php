<?php

require_once CLASSES_PATH . 'Note.php';
require_once MODELS_PATH . 'AbstractModel.php';

class SharedNoteModel extends Model {

	protected string $tableName = 'kn_shared';
	protected Model $userModel;
	protected Model $noteModel;

	public function __construct() {
		$this->userModel = new UserModel();
		$this->noteModel = new NoteModel();
	}

	#[Override]
	public function find(array $conditions) : array {
		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			SELECT *
			FROM {$this->tableName}
			WHERE id_shared_user = :id_shared_user;
		QUERY;

		$stmt = $conn->prepare($sql); //TODO: throw exception
		$stmt->execute($conditions);

		return $this->castToClass($stmt->fetchAll(PDO::FETCH_ASSOC));
	}

	protected function castToClass(array $data) : array {
		$result = [];

		foreach($data as $el) {
			$notes = $this->noteModel->find(['id' => $el['id_note']]);
			$note = $notes[0];
			$user;

			if($note instanceof Note)
				$user = $this->userModel->find(['id' => $note->getOwner()]);

			if($user[0] instanceof User)
				$user = $user[0];

			$result[$user->getUsername()][] = $note;
		}

		return $result;
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