<?php

require_once CLASSES_PATH . 'Note.php';
require_once MODELS_PATH . 'AbstractModel.php';

// I really don't like this class implementation model
class SharedNoteModel extends Model {

	protected string $tableName = 'kn_shared';
	protected Model $userModel;
	protected Model $noteModel;

	public function __construct() {
		$this->userModel = new UserModel();
		$this->noteModel = new NoteModel();
	}

	#[Override]
	public function insert(IDatabasePersistable $data) : bool {
		if(!($data instanceof SharedNote)) return false;

		$user = $this->userModel->find(['email' => $data->getEmail()]);
		if(empty($user) || !($user[0] instanceof User)) return false;

		$data->setIdSharedUser($user[0]->getId());

		if($this->exists(['id_note' => $data->getIdNote(), 'id_shared_user' => $data->getIdSharedUser()]))
			return false;

		$conn = DatabaseClientFactory::getFactory()->getConnection();

		$sql = <<<QUERY
			INSERT INTO {$this->tableName}
			{$this->getInsertStatement()}
		QUERY;

		$stmt = $conn->prepare($sql);
		return $stmt->execute($data->getDBInsertBindings());
	}

	protected function castToClass(array $data) : array {
		$result = [];

		foreach($data as $el) {
			$notes = $this->noteModel->find(['id' => $el['id_note']]);
			if(empty($notes)) continue;

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
			id_note = :id_note, id_shared_user = :id_shared_user
		STMT;
	}

	protected function getInsertStatement() : string {
		return <<<STMT
			(id_note, id_shared_user)
			VALUES (:id_note, :id_shared_user);
		STMT;
	}
}