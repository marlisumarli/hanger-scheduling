<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Domain\KaryawanDetail;

class KaryawanDetailRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    public function save(KaryawanDetail $karyawanDetail): KaryawanDetail
    {
        $statement = $this->connection
            ->prepare("INSERT INTO karyawan_details(username, name, bagian_id ) VALUES (?,?,?)");
        $statement->execute([$karyawanDetail->username, $karyawanDetail->name, $karyawanDetail->bagianId]);
        return $karyawanDetail;
    }

    public function update(KaryawanDetail $karyawanDetail): KaryawanDetail
    {
        $statement = $this->connection
            ->prepare("UPDATE karyawan_details SET name = ?, bagian_id = ?, updated_at = CURRENT_TIMESTAMP WHERE username = ?");
        $statement->execute([$karyawanDetail->name, $karyawanDetail->bagianId, $karyawanDetail->username]);
        return $karyawanDetail;
    }

    public function findByUsername(string $username): ?KaryawanDetail
    {
        $statement = $this->connection
            ->prepare("SELECT id, username, name, bagian_id, updated_at FROM karyawan_details WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $detailKaryawan = new KaryawanDetail();
                $detailKaryawan->id = $row['id'];
                $detailKaryawan->username = $row['username'];
                $detailKaryawan->name = $row['name'];
                $detailKaryawan->bagianId = $row['bagian_id'];
                $detailKaryawan->updatedAt = $row['updated_at'];
                return $detailKaryawan;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM karyawan_details");
    }
}
