<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\K1A;

class K1ARepositoryTest extends TestCase
{
    private K1ARepository $k1aRepository;

    public function testSaveSuccess()
    {
        $k1a = new K1A();
        $k1a->kode = 'K1AFDR';
        $k1a->name = 'Fender';
        $k1a->qty = 4;

        $this->k1aRepository->save($k1a);

        $result = $this->k1aRepository->findByKode($k1a->kode);

        self::assertEquals($k1a->kode, $result->kode);
        self::assertEquals($k1a->name, $result->name);
        self::assertIsInt($k1a->qty, $result->qty);
        self::assertNotNull($result->createdAt);
    }

    public function testFindById()
    {
        $k1a = new K1A();
        $k1a->kode = 'K1AFDR';
        $k1a->name = 'Fender';
        $k1a->qty = 4;

        $this->k1aRepository->save($k1a);

        $result = $this->k1aRepository->findByKode($k1a->kode);

        self::assertEquals($k1a->kode, $result->kode);
        self::assertEquals($k1a->name, $result->name);
        self::assertIsInt($k1a->qty, $result->qty);
    }

    public function testUpdate()
    {
        $k1a = new K1A();
        $k1a->kode = 'K1AFDR';
        $k1a->name = 'Fender';
        $k1a->qty = 4;

        $this->k1aRepository->save($k1a);

        $k1a = new K1A();
        $k1a->kode = 'K1AFDR';
        $k1a->name = 'Fender';
        $k1a->qty = 8;

        $this->k1aRepository->update($k1a);

        $result = $this->k1aRepository->findByKode($k1a->kode);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $k1a = new K1A();
        $k1a->kode = 'K1AFDR';
        $k1a->name = 'Fender';
        $k1a->qty = 4;

        $this->k1aRepository->save($k1a);

        $this->k1aRepository->deleteByKode($k1a->kode);

        $result = $this->k1aRepository->findByKode($k1a->kode);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->k1aRepository = new K1ARepository(Database::getConnection());
        $this->k1aRepository->deleteAll();
    }
}
