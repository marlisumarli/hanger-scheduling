<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Session;
use Subjig\Report\Model\User;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;

    public function testSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = 'marleess';

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);
        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->username, $result->username);
    }

    public function testFindById()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = 'marleess';

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($session->id, $result->id);
        self::assertEquals($session->username, $result->username);
    }

    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById("gadaeuy");
        self::assertNull($result);
    }

    public function testDeleteByIdSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->username = 'marleess';

        $this->sessionRepository->save($session);

        $this->sessionRepository->deleteById($session->id);

        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $karyawanRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());

        $this->sessionRepository->deleteAll();
        $karyawanRepository->deleteAll();

        $user = new User();
        $user->username = "marleess";
        $user->password = "cobain";

        $karyawanRepository->save($user);
    }
}
