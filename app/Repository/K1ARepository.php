<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\K1A;

class K1ARepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(K1A $k1a): K1A
    {
        $statement = $this->connection->prepare("INSERT INTO k1a(kode, name, qty, created_at) VALUES (?,?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$k1a->kode, $k1a->name, $k1a->qty]);
        return $k1a;
    }

    public function update(K1A $k1a): K1A
    {
        $statement = $this->connection
            ->prepare("UPDATE k1a SET name = ?, updated_at = CURRENT_TIMESTAMP WHERE  kode = ?");
        $statement->execute([$k1a->name, $k1a->kode]);
        return $k1a;
    }

    public function findByKode(string $kode): ?K1A
    {
        $statement = $this->connection->prepare("SELECT kode, name, qty, created_at, updated_at FROM k1a WHERE kode = ?");
        $statement->execute([$kode]);

        try {
            if ($row = $statement->fetch()) {
                $category = new K1A();
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
        $statement = $this->connection->prepare("DELETE FROM k1a WHERE kode = ?");
        $statement->execute([$kode]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM k1a");
    }
}