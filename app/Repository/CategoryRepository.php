<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Category;

class CategoryRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Category $category): Category
    {
        $statement = $this->connection->prepare("INSERT INTO category(kode, name, created_at) VALUES (?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$category->kode, $category->name]);
        return $category;
    }

    public function update(Category $category): Category
    {
        $statement = $this->connection
            ->prepare("UPDATE category SET name = ?, updated_at = CURRENT_TIMESTAMP WHERE  kode = ?");
        $statement->execute([$category->name, $category->kode]);
        return $category;
    }

    public function findByKode(string $kode): ?Category
    {
        $statement = $this->connection->prepare("SELECT kode, name, created_at, updated_at FROM category WHERE kode = ?");
        $statement->execute([$kode]);

        try {
            if ($row = $statement->fetch()) {
                $category = new Category();
                $category->kode = $row['kode'];
                $category->name = $row['name'];
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
        $statement = $this->connection->prepare("DELETE FROM category WHERE kode = ?");
        $statement->execute([$kode]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM category");
    }

    public function findAll(): array
    {
        $sql = "SELECT kode, name, created_at, updated_at FROM category";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $category = $statement->fetchAll();

        foreach ($category as $row) {
            $category = new Category();
            $category->setKode($row['kode']);
            $category->setName($row['name']);
            $category->setCreatedAt($row['created_at']);
            $category->setUpdatedAt($row['updated_at']);

            $result[] = $category;
        }
        return $result;
    }
}