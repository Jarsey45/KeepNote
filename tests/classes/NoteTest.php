<?php 
declare(strict_types=1);

namespace Tests\Unit;

require_once './config.php';
require_once CLASSES_PATH . 'Note.php';

use PHPUnit\Framework\TestCase;
use App\Note;

final class NoteTest extends TestCase
{
	public function testCreatingNote() : void {
		$note = (new Note(-100))
			->setOwner(-100)
			->setTitle('testCreation')
			->setContent('testCreation')
			->setColor('testCreation')
			->setDateCreated('1970-01-01');

		$this->assertObjectHasProperty('id', $note);
		$this->assertObjectHasProperty('id_owner', $note);
		$this->assertObjectHasProperty('title', $note);
		$this->assertObjectHasProperty('content', $note);
		$this->assertObjectHasProperty('color', $note);
		$this->assertObjectHasProperty('date_created', $note);
	}

	public function testDateFormat() : void {
		$note = (new Note(-100))
			->setDateCreated('1970-01-01');

		$this->assertEquals('01 Jan 1970', $note->getDateCreated());

		// wrong date format
		$note->setDateCreated('1970 01 01');

		$this->assertEquals('1970 01 01', $note->getDateCreated());
	}

	public function testInsertBindings() : void {
		$note = (new Note(-100))
			->setOwner(-100)
			->setTitle('testCreation')
			->setContent('testCreation')
			->setColor('testCreation')
			->setDateCreated('1970-01-01');


		$expected = [
			':id_owner' => -100,
			':title' => 'testCreation',
			':content' => 'testCreation',
			':color' => 'testCreation',
		];

		$this->assertEquals($expected, $note->getDBInsertBindings());
	}

	public function testUpdateBindings() : void {
		$note = (new Note(-100))
			->setOwner(-100)
			->setTitle('testCreation')
			->setContent('testCreation')
			->setColor('testCreation')
			->setDateCreated('1970-01-01');


		$expected = [
			':id' => -100,
			':title' => 'testCreation',
			':content' => 'testCreation',
		];

		$this->assertEquals($expected, $note->getDBUpdateBindings());
	}
}