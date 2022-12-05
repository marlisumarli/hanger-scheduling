<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\HTTP\Request\UserRequest;
use Subjig\Report\Repository\UserRepository;
use function PHPUnit\Framework\assertNotNull;

class UserServiceTest extends TestCase
{
    private UserService $userService;

    public function testCreateUser()
    {
        $request = new UserRequest();
        $request->username = 'admin';
        $request->password = 'admin';
        $request->fullName = 'Admin';
        $request->role = 1;
        $response = $this->userService->requestCreateUser($request);
        assertNotNull($response);
    }

    protected function setUp(): void
    {
        $userRepository = new UserRepository(Database::getConnection('prod'));

        $this->userService = new UserService($userRepository);
    }
}
