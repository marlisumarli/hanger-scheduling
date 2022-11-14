<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Supply;

class SupplyRepositoryTest extends TestCase
{
    private SupplyRepository $supplyRepository;

    public function testSave()
    {
        $type = 'K2F';
        $date = '2022-11-12';

        $supply = new Supply();
        $supply->supply_id = str_replace(array("-", ":", "/"), '', $date) . $type;
        $supply->supply_date = $date;
        $this->supplyRepository->save($supply);

        $result = $this->supplyRepository->findById($supply->supply_id);

        self::assertNotNull($supply);
    }

    protected function setUp(): void
    {
        $this->supplyRepository = new SupplyRepository(Database::getConnection());
        $this->supplyRepository->deleteAll();
    }
}
