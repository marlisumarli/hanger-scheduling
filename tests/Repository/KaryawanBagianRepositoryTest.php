<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Domain\KaryawanBagian;

class KaryawanBagianRepositoryTest extends TestCase
{
    private KaryawanBagianRepository $karyawanBagianRepository;

    public function testSuccess()
    {
        $karyawanBagian = new KaryawanBagian();
        $karyawanBagian->bagianId = 1;
        $karyawanBagian->name = 'Supply Subjig';

        $this->karyawanBagianRepository->save($karyawanBagian);

        $result = $this->karyawanBagianRepository->findById($karyawanBagian->bagianId);
        self::assertEquals($karyawanBagian->bagianId, $result->bagianId);
        self::assertEquals($karyawanBagian->name, $result->name);
        self::assertNotNull($result->createdAt);

    }

    public function testFindById()
    {
        $karyawanBagian = new KaryawanBagian();
        $karyawanBagian->bagianId = 1;
        $karyawanBagian->name = 'Supply Subjig';

        $this->karyawanBagianRepository->save($karyawanBagian);

        $result = $this->karyawanBagianRepository->findById($karyawanBagian->bagianId);

        self::assertEquals($karyawanBagian->bagianId, $result->bagianId);
        self::assertEquals($karyawanBagian->name, $result->name);
    }

    public function testUpdate()
    {
        $karyawanBagian = new KaryawanBagian();
        $karyawanBagian->bagianId = 1;
        $karyawanBagian->name = 'Supply Subjig';

        $this->karyawanBagianRepository->save($karyawanBagian);

        $karyawanBagian = new KaryawanBagian();
        $karyawanBagian->bagianId = 1;
        $karyawanBagian->name = 'Subjig Supply';

        $this->karyawanBagianRepository->update($karyawanBagian);

        $result = $this->karyawanBagianRepository->findById(1);

        self::assertNotNull($result->updatedAt);
    }


    public function testDeleteByIdSuccess()
    {
        $kBagian = new KaryawanBagian();
        $kBagian->bagianId = 1;
        $kBagian->name = 'Subjig';

        $this->karyawanBagianRepository->save($kBagian);

        $this->karyawanBagianRepository->deleteById($kBagian->bagianId);

        $result = $this->karyawanBagianRepository->findById($kBagian->bagianId);
        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->karyawanBagianRepository = new KaryawanBagianRepository(Database::getConnection());
        $this->karyawanBagianRepository->deleteAll();
    }
}
