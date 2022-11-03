<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Entity\K2F;

class K2FRepositoryTest extends TestCase
{
    private K2FRepository $k2fRepository;

    public function testSaveSuccess()
    {
        $k2f = new K2F();
        $k2f->kode = 'K2FSA';
        $k2f->name = 'Speedometer A';
        $k2f->qty = 4;

        $this->k2fRepository->save($k2f);

        $result = $this->k2fRepository->findByKode($k2f->kode);

        self::assertEquals($k2f->kode, $result->kode);
        self::assertEquals($k2f->name, $result->name);
        self::assertIsInt($k2f->qty, $result->qty);
        self::assertNotNull($result->createdAt);
    }

    public function testFindById()
    {
        $k2f = new K2F();
        $k2f->kode = 'K2FSA';
        $k2f->name = 'Speedometer A';
        $k2f->qty = 4;

        $this->k2fRepository->save($k2f);

        $result = $this->k2fRepository->findByKode($k2f->kode);

        self::assertEquals($k2f->kode, $result->kode);
        self::assertEquals($k2f->name, $result->name);
        self::assertIsInt($k2f->qty, $result->qty);
    }

    public function testUpdate()
    {
        $k2f = new K2F();
        $k2f->kode = 'K2FSA';
        $k2f->name = 'Speedometer A';
        $k2f->qty = 4;

        $this->k2fRepository->save($k2f);

        $k2f = new K2F();
        $k2f->kode = 'K2FSA';
        $k2f->name = 'Speedometer A';
        $k2f->qty = 8;

        $this->k2fRepository->update($k2f);

        $result = $this->k2fRepository->findByKode($k2f->kode);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $k2f = new K2F();
        $k2f->kode = 'K2FSA';
        $k2f->name = 'Speedometer A';
        $k2f->qty = 4;

        $this->k2fRepository->save($k2f);

        $this->k2fRepository->deleteByKode($k2f->kode);

        $result = $this->k2fRepository->findByKode($k2f->kode);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->k2fRepository = new K2FRepository(Database::getConnection());
        $this->k2fRepository->deleteAll();
    }
}
