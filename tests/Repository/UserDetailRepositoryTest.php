<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\User;
use Subjig\Report\Model\UserDetail;

class UserDetailRepositoryTest extends TestCase
{
    private UserDetailRepository $userDetail;

    public function testSaveSuccess()
    {
        $userDetail = new UserDetail();
        $userDetail->username = "marleess";
        $userDetail->name = "marleess";
        $userDetail->roleId = 1;

        $this->userDetail->save($userDetail);

        $result = $this->userDetail->findByUsername($userDetail->username);

        self::assertEquals($userDetail->username, $result->username);
        self::assertEquals($userDetail->name, $result->name);
        self::assertEquals($userDetail->roleId, $result->roleId);
    }

    public function testUpdate()
    {
        $userDetail = new UserDetail();
        $userDetail->username = "marleess";
        $userDetail->name = "marleess";
        $userDetail->roleId = 1;

        $this->userDetail->save($userDetail);

        $userDetail = new UserDetail();
        $userDetail->username = "marleess";
        $userDetail->name = "Marli";
        $userDetail->roleId = 2;

        $this->userDetail->update($userDetail);

        $result = $this->userDetail->findByUsername($userDetail->username);
        self::assertEquals($userDetail->name, $result->name);
        self::assertEquals($userDetail->roleId, $result->roleId);
        self::assertNotNull($result->updatedAt);
    }

    protected function setUp(): void
    {
        $this->userDetail = new UserDetailRepository(Database::getConnection());
        $this->userDetail->deleteAll();
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userRepository->deleteAll();

        $user = new User();
        $user->username = "marleess";
        $user->password = "marleess";
        $this->userRepository->save($user);
    }
}
