<?php

namespace Subjig\Report\Service;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Repository\SubjigRepository;

class SubjigServiceTest extends TestCase
{
    private SubjigService $subjigService;

    public function testCreate()
    {

    }

    protected function setUp(): void
    {
        $subjigRepository = new SubjigRepository(Database::getConnection());
        $this->subjigService = new SubjigService($subjigRepository);
    }
}
