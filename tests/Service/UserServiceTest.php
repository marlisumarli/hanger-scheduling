<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\User;
use Subjig\Report\Model\UserDelete;
use Subjig\Report\Model\UserLogin;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;

    public function testCreateUser()
    {
        $request = new User();
        $request->username = "marleess";
        $request->password = "123";
        $response = $this->userService->requestCreateUser($request);

        self::assertEquals($request->username, $response->user->username);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testLogin()
    {
        $request = new User();
        $request->username = "marleess";
        $request->password = "123";
        $this->userService->requestCreateUser($request);

        $request = new UserLogin();
        $request->username = "marleess";
        $request->password = "123";
        $response = $this->userService->requestLogin($request);

        self::assertEquals($request->username, $response->user->username);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testDelete()
    {
        $request = new User();
        $request->username = "marleess";
        $request->password = "123";
        $this->userService->requestCreateUser($request);

        $request = new UserDelete();
        $request->username = "marleess";
        $this->userService->requestDeleteUser($request);

        $request = $this->userRepository->findByUsername($request->username);

        self::assertNull($request);
    }

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);
        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailService = new UserDetailService($this->userDetailRepository);

        $this->userRepository->deleteAll();
    }
}
