<?php 
declare(strict_types=1);

namespace Tests\Unit;

require_once './config.php';
require_once MODELS_PATH . 'UserModel.php';

use PHPUnit\Framework\TestCase;
use App\UserModel;
use App\User;
use App\Roles;

final class UserModelTest extends TestCase
{
		public function testThrowsTypeErrorInsertingInvalidData(): void {
			$model = new UserModel();
			
			$data = ['id' => 1];

			$this->expectException(\TypeError::class);
			$model->insert($data);
		}

		public function testThrowsErrorInsertingIncompleteData(): void {
			$model = new UserModel();
			
			$data = (new User(-1))
        ->setUsername('test')
        ->setPassword('test')
        ->setRole(Roles::TEST_UNIT);

			$this->expectException(\Error::class);
			$model->insert($data);
		}

		public function testThrowsErrorUpdatingInvalidData(): void {
			$model = new UserModel();
			
			$data = ['id' => 1];
			$this->expectException(\TypeError::class);
			$model->update($data);
		}

		public function testInsertingValidData() : void {
			$model = new UserModel();

			$data = (new User(-1))
        ->setUsername('testInsert')
        ->setPassword('testInsert')
        ->setEmail('testInsert')
        ->setRole(Roles::TEST_UNIT);

			$response = $model->insert($data);
			$expected = true;

			$this->assertEquals($expected, $response);
		}

		public function testUpdateValidData() : void {
			$model = new UserModel();

			$testUser = $model->find(['id_role' => Roles::TEST_UNIT->value])[0];
			$this->assertInstanceOf(User::class, $testUser);

			$data = (new User($testUser->getId()))
				->setUsername('testUpdate')
				->setPassword('testUpdate')
				->setEmail('testUpdate');

			$response = $model->update($data);
			$expected = true;

			$this->assertEquals($expected, $response);
		}

		public function testDeleteValidData() : void {
			$model = new UserModel();

			$testUser = $model->find(['id_role' => Roles::TEST_UNIT->value])[0];
			$this->assertInstanceOf(User::class, $testUser);

			$response = $model->delete($testUser->getId());
			$expected = true;

			$this->assertEquals($expected, $response);
		}
}