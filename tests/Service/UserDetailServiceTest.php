<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\User;
use Subjig\Report\Model\UserDetailCreateRequest;
use Subjig\Report\Model\UserDetailUpdateRequest;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;

class UserDetailServiceTest extends TestCase
{
    private UserDetailService $userDetailService;
    private UserDetailRepository $userDetailRepository;

    public function testSaveSuccess()
    {
        $userDet = new UserDetailCreateRequest();
        $userDet->credential = "marleess";
        $userDet->fullName = "marli sumarli";
        $userDet->role = 1;
        $this->userDetailService->requestCreateUserDetail($userDet);

        $result = $this->userDetailRepository->findByUsername($userDet->credential);
        self::assertEquals("Marli Sumarli", $result->fullName);
    }

    public function testUpdateSuccess()
    {
        $userDet = new UserDetailCreateRequest();
        $userDet->credential = "marleess";
        $userDet->fullName = "marli sumarli";
        $userDet->role = 1;
        $this->userDetailService->requestCreateUserDetail($userDet);

        $userDetUpdate = new UserDetailUpdateRequest();
        $userDetUpdate->credential = "marleess";
        $userDetUpdate->fullName = "marli ";
        $userDetUpdate->role = 1;

        $this->userDetailService->requestUpdateUserDetail($userDetUpdate);

        $result = $this->userDetailRepository->findByUsername($userDet->credential);
        self::assertEquals("Marli", $result->fullName);
    }

    protected function setUp(): void
    {
        $userRepository = new UserRepository(Database::getConnection());
        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailService = new UserDetailService($this->userDetailRepository);

        $userRepository->deleteAll();

        $user = new User();
        $user->username = "marleess";
        $user->password = "123";
        $userRepository->save($user);
    }
}
