<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Model\Subjig;

class SubjigRepositoryTest extends TestCase
{
    private SubjigRepository $subjigRepository;

    public function testSave()
    {
        $subjig = new Subjig();
        $subjig->setSubjigId('SPDMTA');
        $subjig->setTypeId('K2F');
        $subjig->setOrderNumber(1);
        $subjig->setSubjigName('Speedometer A');
        $subjig->setSubjigQty(4);
        $this->subjigRepository->save($subjig);

        $result = $this->subjigRepository->findById($subjig->getSubjigId());

        self::assertNotNull($result);
    }

    protected function setUp(): void
    {
        $this->subjigRepository = new SubjigRepository(Database::getConnection());
        $this->subjigRepository->deleteAll();
    }
}
