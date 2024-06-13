<?php 
declare(strict_types=1);

namespace Tests\Unit;

require_once './config.php';
require_once CLASSES_PATH . 'User.php';

use PHPUnit\Framework\TestCase;
use App\User;
use App\Roles;

final class userTest extends TestCase
{
	public function testCreatinguser() : void {
		$user = (new User(-100))
      ->setUsername('testCreation')
      ->setEmail('testCreation')
      ->setPassword('testCreation')
      ->setRole(Roles::TEST_UNIT)
      ->setDateCreated('1970-01-01');

		$this->assertObjectHasProperty('id', $user);
		$this->assertObjectHasProperty('username', $user);
		$this->assertObjectHasProperty('password', $user);
		$this->assertObjectHasProperty('email', $user);
		$this->assertObjectHasProperty('role', $user);
		$this->assertObjectHasProperty('date_created', $user);
	}

	public function testDateFormat() : void {
		$user = (new User(-100))
			->setDateCreated('1970-01-01');

		$this->assertEquals('01 Jan 1970', $user->getDateCreated());

		// wrong date format
		$user->setDateCreated('1970 01 01');

		$this->assertEquals('1970 01 01', $user->getDateCreated());
	}

	public function testInsertBindings() : void {
		$user = (new User(-100))
      ->setUsername('testCreation')
      ->setEmail('testCreation')
      ->setPassword('testCreation')
      ->setRole(Roles::TEST_UNIT)
      ->setDateCreated('1970-01-01');


      $expected = [
        ':username' => 'testCreation',
        ':password' => 'testCreation',
        ':email' => 'testCreation',
        ':role' => Roles::TEST_UNIT->value,
      ];

		$this->assertEquals($expected, $user->getDBInsertBindings());
	}

	public function testUpdateBindings() : void {
		$user = (new User(-100))
      ->setUsername('testCreation')
      ->setEmail('testCreation')
      ->setPassword('testCreation')
      ->setRole(Roles::TEST_UNIT)
      ->setDateCreated('1970-01-01');


		$expected = [
			':id' => -100,
			':username' => 'testCreation',
			':password' => 'testCreation',
      ':email' => 'testCreation',
		];

		$this->assertEquals($expected, $user->getDBUpdateBindings());
	}
}