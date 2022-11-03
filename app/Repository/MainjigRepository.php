<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Mainjig;

class MainjigRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Mainjig $mainjig): Mainjig
    {
        $statement = $this->connection->prepare("INSERT INTO mainjig(kode, name, qty, created_at) VALUES (?,?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$mainjig->kode, $mainjig->name, $mainjig->qty]);
        return $mainjig;
    }

    public function update(Mainjig $mainjig): Mainjig
    {
        $statement = $this->connection
            ->prepare("UPDATE mainjig SET name = ?, updated_at = CURRENT_TIMESTAMP WHERE  kode = ?");
        $statement->execute([$mainjig->name, $mainjig->kode]);
        return $mainjig;
    }

    public function findByKode(string $kode): ?Mainjig
    {
        $statement = $this->connection->prepare("SELECT kode, name, qty, created_at, updated_at FROM mainjig WHERE kode = ?");
        $statement->execute([$kode]);

        try {
            if ($row = $statement->fetch()) {
                $category = new Mainjig();
                $category->kode = $row['kode'];
                $category->name = $row['name'];
                $category->qty = $row['qty'];
                $category->createdAt = $row['created_at'];
                $category->updatedAt = $row['updated_at'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteByKode(string $kode): void
    {
        $statement = $this->connection->prepare("DELETE FROM mainjig WHERE kode = ?");
        $statement->execute([$kode]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM mainjig");
    }
}