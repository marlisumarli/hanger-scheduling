<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Messboat;

class MessboatRepositoryTest extends TestCase
{
    private MessboatRepository $messboatRepository;

    public function testSaveSuccess()
    {
        $messboat = new Messboat();
        $messboat->kode = 'MJLNA';
        $messboat->name = 'Messboat Line A';
        $messboat->qty = 444;

        $this->messboatRepository->save($messboat);

        $result = $this->messboatRepository->findByKode($messboat->kode);

        self::assertEquals($messboat->kode, $result->kode);
        self::assertEquals($messboat->name, $result->name);
        self::assertIsInt($messboat->qty, $result->qty);
        self::assertNotNull($result->createdAt);
    }

    public function testFindById()
    {
        $messboat = new Messboat();
        $messboat->kode = 'MJLNA';
        $messboat->name = 'Messboat Line A';
        $messboat->qty = 444;

        $this->messboatRepository->save($messboat);

        $result = $this->messboatRepository->findByKode($messboat->kode);

        self::assertEquals($messboat->kode, $result->kode);
        self::assertEquals($messboat->name, $result->name);
        self::assertIsInt($messboat->qty, $result->qty);
    }

    public function testUpdate()
    {
        $messboat = new Messboat();
        $messboat->kode = 'MJLNA';
        $messboat->name = 'Messboat Line A';
        $messboat->qty = 444;

        $this->messboatRepository->save($messboat);

        $messboat = new Messboat();
        $messboat->kode = 'MJLNA';
        $messboat->name = 'Messboat Line A';
        $messboat->qty = 8;

        $this->messboatRepository->update($messboat);

        $result = $this->messboatRepository->findByKode($messboat->kode);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $messboat = new Messboat();
        $messboat->kode = 'MJLNA';
        $messboat->name = 'Messboat Line A';
        $messboat->qty = 444;

        $this->messboatRepository->save($messboat);

        $this->messboatRepository->deleteByKode($messboat->kode);

        $result = $this->messboatRepository->findByKode($messboat->kode);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->messboatRepository = new MessboatRepository(Database::getConnection());
        $this->messboatRepository->deleteAll();
    }
}
