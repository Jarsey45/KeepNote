<?php 
declare(strict_types=1);

namespace Tests\Unit;

require_once './config.php';
require_once MODELS_PATH . 'NoteModel.php';

use PHPUnit\Framework\TestCase;
use App\NoteModel;
use App\Note;

final class NoteModelTest extends TestCase
{
		public function testThrowsTypeErrorInsertingInvalidData(): void {
			$model = new NoteModel();
			
			$data = ['id' => 1];

			$this->expectException(\TypeError::class);
			$model->insert($data);
		}

		public function testThrowsErrorInsertingIncompleteData(): void {
			$model = new NoteModel();
			
			$data = (new Note(-1))
				->setTitle('test')
				->setContent('test');

			$this->expectException(\Error::class);
			$model->insert($data);
		}

		public function testThrowsErrorUpdatingInvalidData(): void {
			$model = new NoteModel();
			
			$data = ['id' => 1];
			$this->expectException(\TypeError::class);
			$model->update($data);
		}

		public function testInsertingValidData() : void {
			$model = new NoteModel();

			$data = (new Note(-1))
				->setOwner(-100)
				->setTitle('testInsert')
				->setContent('testInsert')
				->setColor('testInsert');

			$response = $model->insert($data);
			$expected = true;

			$this->assertEquals($expected, $response);
		}

		public function testUpdateValidData() : void {
			$model = new NoteModel();

			$testNote = $model->find(['id_owner' => -100])[0];
			$this->assertInstanceOf(Note::class, $testNote);

			$data = (new Note($testNote->getId()))
				->setTitle('testUpdate')
				->setContent('testUpdate');

			$response = $model->update($data);
			$expected = true;

			$this->assertEquals($expected, $response);
		}

		public function testDeleteValidData() : void {
			$model = new NoteModel();

			$testNote = $model->find(['id_owner' => -100])[0];
			$this->assertInstanceOf(Note::class, $testNote);

			$response = $model->delete($testNote->getId());
			$expected = true;

			$this->assertEquals($expected, $response);
		}
}