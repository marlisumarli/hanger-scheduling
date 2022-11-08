<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;

class JoinRepositoryTest extends TestCase
{
    private JoinRepository $joinRepository;

    public function testUserData()
    {
        $result = $this->joinRepository->userData();
        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->joinRepository = new JoinRepository(Database::getConnection());
    }
}
