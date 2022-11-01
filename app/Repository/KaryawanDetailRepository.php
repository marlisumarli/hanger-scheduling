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
            ->prepare("INSERT INTO karyawan_details(username, name, bagian_id ) VALUES (?,?,?,?)");
        $statement->execute([$karyawanDetail->username, $karyawanDetail->name, $karyawanDetail->bagianId]);
        return $karyawanDetail;
    }

    public function update(KaryawanDetail $karyawanDetail): KaryawanDetail
    {
        $statement = $this->connection
            ->prepare("UPDATE karyawan_details SET name = ?, bagian_id = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $statement->execute([$karyawanDetail->name, $karyawanDetail->bagianId, $karyawanDetail->id]);
        return $karyawanDetail;
    }

    public function findByUsername(string $username): ?KaryawanDetail
    {
        $statement = $this->connection
            ->prepare("SELECT id, username, name, bagian_id, updated_at FROM karyawan_details WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $kD = new KaryawanDetail();
                $kD->id = $row['id'];
                $kD->username = $row['username'];
                $kD->name = $row['name'];
                $kD->bagianId = $row['bagian_id'];
                $kD->updatedAt = $row['updated_at'];
                return $kD;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById()
    {

    }
}