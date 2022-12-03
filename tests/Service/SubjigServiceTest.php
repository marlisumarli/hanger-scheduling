<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\HangerRepository;

class SubjigServiceTest extends TestCase
{
    private HangerService $subjigService;

    public function testCreate()
    {

    }

    protected function setUp(): void
    {
        $subjigRepository = new HangerRepository(Database::getConnection());
        $this->subjigService = new HangerService($subjigRepository);
    }
}
