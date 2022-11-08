<?php

namespace Subjig\Report\Service;

require __DIR__ . '/../Helper/helper.php';

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Session;
use Subjig\Report\Entity\User;
use Subjig\Report\Repository\SessionRepository;
use Subjig\Report\Repository\UserRepository;

class SessionServiceTest extends TestCase
{
    private SessionService $sessionService;
    private SessionRepository $sessionRepository;

    public function testCreate()
    {
        $session = $this->sessionService->create("marleess");
        $this->expectOutputRegex("[LOGIN: $session->id]");
        $result = $this->sessionRepository->findById($session->id);
        self::assertEquals("marleess", $result->username);
    }

    public function testDestroy()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = "marleess";
        $this->sessionRepository->save($session);

        $_COOKIE[ SessionService::COOKIE_NAME ] = $session->id;
        $this->sessionService->destroy();
        $this->expectOutputRegex("[LOGIN: ]");
        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }

    public function testCurrent()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = "marleess";

        $this->sessionRepository->save($session);

        $_COOKIE[ SessionService::COOKIE_NAME ] = $session->id;

        $user = $this->sessionService->current();

        self::assertEquals($session->username, $user->username);
    }

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $userRepository);

        $this->sessionRepository->deleteAll();
        $userRepository->deleteAll();

        $user = new User();
        $user->username = "marleess";
        $user->password = "cobadoang";

        $userRepository->save($user);

    }
}

