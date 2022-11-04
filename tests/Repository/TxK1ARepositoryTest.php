<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\TxK1A;

class TxK1ARepositoryTest extends TestCase
{
    private TxK1ARepository $txK1ARepository;

    public function testSave()
    {
        $date = '2022-11-03';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK1A = new TxK1A();
        $txK1A->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK1A->categoryCode = "K2F-S-LN-A";
        $txK1A->type = "K2F";
        $txK1A->year = $currentYearOnly();
        $txK1A->chf = 80;
        $txK1A->speedometer = 80;
        $txK1A->bodyR = 50;
        $txK1A->bodyL = 123;
        $txK1A->fender = 122;
        $txK1A->supplyTanggal = $date;

        $this->txK1ARepository->save($txK1A);

        $result = $this->txK1ARepository->findById($txK1A->id);
        self::assertNotNull($result->supplyTanggal);
    }

    public function testUpdate()
    {
        $date = '2022-11-03';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK1A = new TxK1A();
        $txK1A->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK1A->categoryCode = "K2F-S-LN-A";
        $txK1A->type = "K2F";
        $txK1A->year = $currentYearOnly();
        $txK1A->chf = 80;
        $txK1A->speedometer = 80;
        $txK1A->bodyR = 50;
        $txK1A->bodyL = 123;
        $txK1A->fender = 122;
        $txK1A->supplyTanggal = $date;

        $this->txK1ARepository->save($txK1A);

        $txK1A = new TxK1A();
        $txK1A->id = "20221103K2F-S-LN-A";
        $txK1A->categoryCode = "K2F-S-LN-A";
        $txK1A->supplyTanggal = "2022-10-03";
        $this->txK1ARepository->update($txK1A);

        $result = $this->txK1ARepository->findById($txK1A->id);
        self::assertNotNull($result->updatedAt);
    }

    public function testDeleteById()
    {
        $date = '2022-11-03';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK1A = new TxK1A();
        $txK1A->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK1A->categoryCode = "K2F-S-LN-A";
        $txK1A->type = "K2F";
        $txK1A->year = $currentYearOnly();
        $txK1A->chf = 80;
        $txK1A->speedometer = 80;
        $txK1A->bodyR = 50;
        $txK1A->bodyL = 123;
        $txK1A->fender = 122;
        $txK1A->supplyTanggal = $date;

        $this->txK1ARepository->save($txK1A);

        $date = '2022-11-04';
        $category = 'K2F-S-LN-A';
        $currentYearOnly = fn() => date('Y', strtotime($date));
        $txK1A = new TxK1A();
        $txK1A->id = str_replace(array("-", ":", "/"), '', $date) . $category;
        $txK1A->categoryCode = "K2F-S-LN-A";
        $txK1A->type = "K2F";
        $txK1A->year = $currentYearOnly();
        $txK1A->chf = 80;
        $txK1A->speedometer = 80;
        $txK1A->bodyR = 50;
        $txK1A->bodyL = 123;
        $txK1A->fender = 122;
        $txK1A->supplyTanggal = $date;
        $this->txK1ARepository->save($txK1A);

        $this->txK1ARepository->deleteById($txK1A->id);
        $result = $this->txK1ARepository->findById($txK1A->id);

        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->txK1ARepository = new TxK1ARepository(Database::getConnection());
        $this->txK1ARepository->deleteAll();
    }
}
