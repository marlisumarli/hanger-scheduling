<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\User;

class UserRepositoryTest extends TestCase
{

    private UserRepository $userRepository;

    public function testSave()
    {
        $user = new User();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->userRepository->save($user);

        $result = $this->userRepository->findByUsername($user->username);

        self::assertEquals($user->username, $result->username);
        self::assertEquals($user->password, $result->password);
        self::assertNotNull($result->createdAt);
        self::assertNull($result->updatePasswordAt);
        self::assertNotTrue($result->onlineStatus);
        self::assertNull($result->lastLogin);
    }

    public function testUpdate()
    {
        $user = new User();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->userRepository->save($user);

        $user = new User();
        $user->username = "marleess";
        $user->password = "anyingganti";

        $this->userRepository->update($user);

        $result = $this->userRepository->findByUsername($user->username);

        self::assertEquals($user->password, $result->password);
        self::assertNotNull($result->updatePasswordAt);
    }

    public function testDelete()
    {

        $user = new User();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->userRepository->save($user);

        $user = new User();
        $user->username = "marleess";
        $this->userRepository->deleteByUsername($user->username);
        $result = $this->userRepository->findByUsername($user->username);

        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();
    }

}
