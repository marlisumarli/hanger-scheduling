<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Domain\KaryawanBagian;

class KaryawanBagianRepository
{
    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(KaryawanBagian $karyawanBagian): KaryawanBagian
    {
        $statement = $this->connection
            ->prepare("INSERT INTO karyawan_bagians(id, name, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $statement->execute([$karyawanBagian->bagianId, $karyawanBagian->name]);
        return $karyawanBagian;
    }

    public function update(KaryawanBagian $karyawanBagian): KaryawanBagian
    {
        $statement = $this->connection
            ->prepare("UPDATE karyawan_bagians SET name = ? ,updated_at = CURRENT_TIMESTAMP WHERE  id = ?");
        $statement->execute([$karyawanBagian->name, $karyawanBagian->bagianId]);
        return $karyawanBagian;
    }

    public function findById(int $id): ?KaryawanBagian
    {
        $statement = $this->connection->prepare("SELECT id, name, created_at, updated_at FROM karyawan_bagians WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $karyawanBagian = new KaryawanBagian();
                $karyawanBagian->bagianId = $row['id'];
                $karyawanBagian->name = $row['name'];
                $karyawanBagian->createdAt = $row['created_at'];
                $karyawanBagian->updatedAt = $row['updated_at'];
                return $karyawanBagian;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM karyawan_bagians WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM karyawan_bagians");
    }
}