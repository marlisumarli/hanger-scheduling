<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\K2F;

class K2FRepository
{
    const TYPE = 'k2f';

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(K2F $k2f): K2F
    {
        $statement = $this->connection->prepare("INSERT INTO k2f(code, name, qty, created_at) VALUES (?,?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$k2f->code, $k2f->name, $k2f->qty]);
        return $k2f;
    }

    public function update(K2F $k2f): K2F
    {
        $statement = $this->connection
            ->prepare("UPDATE k2f SET name = ?, qty = ?, updated_at = CURRENT_TIMESTAMP WHERE  code = ?");
        $statement->execute([$k2f->name, $k2f->qty, $k2f->code]);
        return $k2f;
    }

    public function findByCode(string $code): ?K2F
    {
        $statement = $this->connection->prepare("SELECT code, name, qty, created_at, updated_at FROM k2f WHERE code = ?");
        $statement->execute([$code]);

        try {
            if ($row = $statement->fetch()) {
                $category = new K2F();
                $category->code = $row['code'];
                $category->name = $row['name'];
                $category->qty = $row['qty'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findByName(string $name): ?K2F
    {
        $statement = $this->connection->prepare("SELECT code, name, qty, created_at, updated_at FROM k2f WHERE name = ?");
        $statement->execute([$name]);

        try {
            if ($row = $statement->fetch()) {
                $category = new K2F();
                $category->code = $row['code'];
                $category->name = $row['name'];
                $category->qty = $row['qty'];
                return $category;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteByCode(string $code): void
    {
        $statement = $this->connection->prepare("DELETE FROM k2f WHERE code = ?");
        $statement->execute([$code]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM k2f");
    }

    public function findAll(): array
    {
        $sql = "SELECT code, name, qty FROM k2f";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $k2f = $statement->fetchAll();

        foreach ($k2f as $row) {
            $data = new K2F();
            $data->setCode($row['code']);
            $data->setName($row['name']);
            $data->setQty($row['qty']);

            $result[] = $data;
        }
        return $result;
    }
}