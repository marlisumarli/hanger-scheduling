<?php

namespace Subjig\Report\Repository;

use PHPUnit\Framework\TestCase;
use Subjig\Report\Config\Database;
use Subjig\Report\Domain\Karyawan;

class KaryawanRepositoryTest extends TestCase
{

    private KaryawanRepository $karyawanRepository;

    public function testSave()
    {
        $user = new Karyawan();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->karyawanRepository->save($user);

        $result = $this->karyawanRepository->findByUsername($user->username);

        self::assertEquals($user->username, $result->username);
        self::assertEquals($user->password, $result->password);
        self::assertNotNull($result->createdAt);
        self::assertNull($result->updatePasswordAt);
        self::assertNotTrue($result->onlineStatus);
        self::assertNull($result->lastLogin);
    }

    public function testUpdate()
    {
        $user = new Karyawan();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->karyawanRepository->save($user);

        $user = new Karyawan();
        $user->username = "marleess";
        $user->password = "anyingganti";

        $this->karyawanRepository->update($user);

        $result = $this->karyawanRepository->findByUsername($user->username);

        self::assertEquals($user->password, $result->password);
        self::assertNotNull($result->updatePasswordAt);
    }

    public function testDelete()
    {

        $user = new Karyawan();
        $user->username = "marleess";
        $user->password = "marleess";

        $this->karyawanRepository->save($user);

        $user = new Karyawan();
        $user->username = "marleess";
        $this->karyawanRepository->deleteByUsername($user->username);
        $result = $this->karyawanRepository->findByUsername($user->username);


        self::assertNull($result);
    }

    protected function setUp(): void
    {
        $this->karyawanRepository = new KaryawanRepository(Database::getConnection());
        $this->karyawanRepository->deleteAll();
    }

}
