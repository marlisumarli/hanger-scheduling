<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\K2F;

class K2FRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(K2F $k2f): K2F
    {
        $statement = $this->connection->prepare("INSERT INTO k2f(kode, name, qty, created_at) VALUES (?,?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$k2f->kode, $k2f->name, $k2f->qty]);
        return $k2f;
    }

    public function update(K2F $k2f): K2F
    {
        $statement = $this->connection
            ->prepare("UPDATE k2f SET name = ?, updated_at = CURRENT_TIMESTAMP WHERE  kode = ?");
        $statement->execute([$k2f->name, $k2f->kode]);
        return $k2f;
    }

    public function findByKode(string $kode): ?K2F
    {
        $statement = $this->connection->prepare("SELECT kode, name, qty, created_at, updated_at FROM k2f WHERE kode = ?");
        $statement->execute([$kode]);

        try {
            if ($row = $statement->fetch()) {
                $category = new K2F();
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
        $statement = $this->connection->prepare("DELETE FROM k2f WHERE kode = ?");
        $statement->execute([$kode]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM k2f");
    }
}