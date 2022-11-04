<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\User;
use Subjig\Report\Model\UserDetailRequest;
use Subjig\Report\Model\UserFactory;
use Subjig\Report\Model\UserLoginRequest;
use Subjig\Report\Repository\UserDetailRepository;
use Subjig\Report\Repository\UserRepository;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserDetailService $userDetailService;

    public function testMintingUser()
    {
        $request = new UserFactory();
        $request->username = "marlioffice2";
        $request->password = "marli";
        $response1 = $this->userService->mintingUser($request);

        $requestSubmit = new UserDetailRequest();
        $requestSubmit->credential = $request->username;
        $requestSubmit->fullName = "Marleess";
        $requestSubmit->role = 1;
        $response2 = $this->userDetailService->submit($requestSubmit);


        self::assertEquals($request->username, $response1->user->username);
        self::assertTrue(password_verify($request->password, $response1->user->password));
        self::assertEquals($requestSubmit->credential, $response2->userDetail->credential);
        self::assertEquals($requestSubmit->fullName, $response2->userDetail->fullName);
        self::assertEquals($requestSubmit->role, $response2->userDetail->roleId);
    }

    public function testLoginSuccess()
    {
        $user = new User();
        $user->username = "marlioffice";
        $user->password = password_hash("cobadoang", PASSWORD_BCRYPT);
        $this->userRepository->save($user);

        $request = new UserLoginRequest();
        $request->username = "marlioffice";
        $request->password = "cobadoang";

        $response = $this->userService->login($request);

        self::assertEquals($request->username, $response->user->username);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }


    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);
        $this->userDetailRepository = new UserDetailRepository(Database::getConnection());
        $this->userDetailService = new UserDetailService($this->userDetailRepository);

        $this->userDetailRepository->deleteAll();
        $this->userRepository->deleteAll();
    }
}
