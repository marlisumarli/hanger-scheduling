<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Domain\Karyawan;
use Subjig\Report\Domain\KaryawanDetail;

class KaryawanDetailRepositoryTest extends TestCase
{
    private KaryawanDetailRepository $karyawanDetailRepository;

    public function testSaveSuccess()
    {
        $kd = new KaryawanDetail();
        $kd->username = "marleess";
        $kd->name = "marleess";
        $kd->bagianId = 1;

        $this->karyawanDetailRepository->save($kd);

        $result = $this->karyawanDetailRepository->findByUsername($kd->username);

        self::assertEquals($kd->username, $result->username);
        self::assertEquals($kd->name, $result->name);
        self::assertEquals($kd->bagianId, $result->bagianId);
    }

    public function testUpdate()
    {
        $kd = new KaryawanDetail();
        $kd->username = "marleess";
        $kd->name = "marleess";
        $kd->bagianId = 1;

        $this->karyawanDetailRepository->save($kd);

        $kd = new KaryawanDetail();
        $kd->username = "marleess";
        $kd->name = "Marli";
        $kd->bagianId = 2;

        $this->karyawanDetailRepository->update($kd);

        $result = $this->karyawanDetailRepository->findByUsername($kd->username);
        self::assertEquals($kd->name, $result->name);
        self::assertEquals($kd->bagianId, $result->bagianId);
        self::assertNotNull($result->updatedAt);
    }

    protected function setUp(): void
    {
        $this->karyawanDetailRepository = new KaryawanDetailRepository(Database::getConnection());
        $this->karyawanDetailRepository->deleteAll();
        $this->karyawanRepository = new KaryawanRepository(Database::getConnection());
        $this->karyawanRepository->deleteAll();

        $user = new Karyawan();
        $user->username = "marleess";
        $user->password = "marleess";
        $this->karyawanRepository->save($user);
    }
}
