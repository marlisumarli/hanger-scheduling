<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\UserRole;

class UserRoleRepositoryTest extends TestCase
{
    private UserRoleRepository $userRoleRepository;
    private UserDetailRepository $userDetailRepository;

    public function testSaveSuccess()
    {
        $userRole = new UserRole();
        $userRole->roleId = 1;
        $userRole->name = 'Supply Subjig';

        $this->userRoleRepository->save($userRole);

        $result = $this->userRoleRepository->findById($userRole->roleId);
        self::assertEquals($userRole->roleId, $result->roleId);
        self::assertEquals($userRole->name, $result->name);
        self::assertNotNull($result->createdAt);

    }

    public function testFindById()
    {
        $userRole = new UserRole();
        $userRole->roleId = 1;
        $userRole->name = 'Supply Subjig';

        $this->userRoleRepository->save($userRole);

        $result = $this->userRoleRepository->findById($userRole->roleId);

        self::assertEquals($userRole->roleId, $result->roleId);
        self::assertEquals($userRole->name, $result->name);
    }

    public function testUpdate()
    {
        $userRole = new UserRole();
        $userRole->roleId = 1;
        $userRole->name = 'Supply Subjig';

        $this->userRoleRepository->save($userRole);

        $userRole = new UserRole();
        $userRole->roleId = 1;
        $userRole->name = 'Subjig Supply';

        $this->userRoleRepository->update($userRole);

        $result = $this->userRoleRepository->findById(1);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $kBagian = new UserRole();
        $kBagian->roleId = 1;
        $kBagian->name = 'Subjig';

        $this->userRoleRepository->save($kBagian);

        $this->userRoleRepository->deleteById($kBagian->roleId);

        $result = $this->userRoleRepository->findById($kBagian->roleId);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->userRoleRepository = new UserRoleRepository(Database::getConnection());
        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailRepository->deleteAll();
        $this->userRoleRepository->deleteAll();
    }
}
