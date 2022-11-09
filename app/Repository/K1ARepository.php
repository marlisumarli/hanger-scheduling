<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\K1A;

class K1ARepository
{
    const TYPE = 'k1a';
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(K1A $k1a): K1A
    {
        $statement = $this->connection->prepare("INSERT INTO k1a(k1a_id, k1a_name, k1a_qty) VALUES (?,?,?)");
        $statement->execute([$k1a->k1a_id, $k1a->k1a_name, $k1a->k1a_qty]);
        return $k1a;
    }

    public function update(K1A $k1a): K1A
    {
        $statement = $this->connection
            ->prepare("UPDATE k1a SET k1a_name = ?, k1a_qty = ? WHERE  k1a_id = ?");
        $statement->execute([$k1a->k1a_name, $k1a->k1a_qty, $k1a->k1a_id]);
        return $k1a;
    }

    public function findByKode(string $id): ?K1A
    {
        $statement = $this->connection->prepare("SELECT k1a_id, k1a_name, k1a_qty FROM k1a WHERE k1a_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $category = new K1A();
                $category->k1a_id = $row['k1a_id'];
                $category->k1a_name = $row['k1a_name'];
                $category->k1a_qty = $row['k1a_qty'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM k1a WHERE k1a_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM k1a");
    }
}