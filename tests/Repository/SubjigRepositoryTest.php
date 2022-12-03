<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Hanger;

class SubjigRepositoryTest extends TestCase
{
    private HangerRepository $subjigRepository;

    public function testSave()
    {
        $result = $this->subjigRepository->data('K2F');

        var_dump($result);

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->subjigRepository = new HangerRepository(Database::getConnection());
    }
}
