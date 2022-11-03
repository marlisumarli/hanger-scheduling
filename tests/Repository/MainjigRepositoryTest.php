<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\Mainjig;

class MainjigRepositoryTest extends TestCase
{
    private MainjigRepository $mainjigRepository;

    public function testSaveSuccess()
    {
        $mainjig = new Mainjig();
        $mainjig->kode = 'MJLNA';
        $mainjig->name = 'Mainjig Line A';
        $mainjig->qty = 444;

        $this->mainjigRepository->save($mainjig);

        $result = $this->mainjigRepository->findByKode($mainjig->kode);

        self::assertEquals($mainjig->kode, $result->kode);
        self::assertEquals($mainjig->name, $result->name);
        self::assertIsInt($mainjig->qty, $result->qty);
        self::assertNotNull($result->createdAt);
    }

    public function testFindById()
    {
        $mainjig = new Mainjig();
        $mainjig->kode = 'MJLNA';
        $mainjig->name = 'Mainjig Line A';
        $mainjig->qty = 444;

        $this->mainjigRepository->save($mainjig);

        $result = $this->mainjigRepository->findByKode($mainjig->kode);

        self::assertEquals($mainjig->kode, $result->kode);
        self::assertEquals($mainjig->name, $result->name);
        self::assertIsInt($mainjig->qty, $result->qty);
    }

    public function testUpdate()
    {
        $mainjig = new Mainjig();
        $mainjig->kode = 'MJLNA';
        $mainjig->name = 'Mainjig Line A';
        $mainjig->qty = 444;

        $this->mainjigRepository->save($mainjig);

        $mainjig = new Mainjig();
        $mainjig->kode = 'MJLNA';
        $mainjig->name = 'Mainjig Line A';
        $mainjig->qty = 8;

        $this->mainjigRepository->update($mainjig);

        $result = $this->mainjigRepository->findByKode($mainjig->kode);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $mainjig = new Mainjig();
        $mainjig->kode = 'MJLNA';
        $mainjig->name = 'Mainjig Line A';
        $mainjig->qty = 444;

        $this->mainjigRepository->save($mainjig);

        $this->mainjigRepository->deleteByKode($mainjig->kode);

        $result = $this->mainjigRepository->findByKode($mainjig->kode);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->mainjigRepository = new MainjigRepository(Database::getConnection());
        $this->mainjigRepository->deleteAll();
    }
}
