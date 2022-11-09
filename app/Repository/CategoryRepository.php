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
        $statement = $this->connection->prepare("INSERT INTO category(category_id, category_name, created_at) VALUES (?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$category->category_id, $category->category_name]);
        return $category;
    }

    public function update(Category $category): Category
    {
        $statement = $this->connection
            ->prepare("UPDATE category SET category_name = ?, updated_at = CURRENT_TIMESTAMP WHERE  category_id = ?");
        $statement->execute([$category->category_name, $category->category_id]);
        return $category;
    }

    public function findById(string $id): ?Category
    {
        $statement = $this->connection->prepare("SELECT category_id, category_name, created_at, updated_at FROM category WHERE category_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $category = new Category();
                $category->category_id = $row['category_id'];
                $category->category_name = $row['category_name'];
                $category->created_at = $row['created_at'];
                $category->updated_at = $row['updated_at'];
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
        $statement = $this->connection->prepare("DELETE FROM category WHERE category_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM category");
    }

    public function findAll(): array
    {
        $sql = "SELECT category_id, category_name, created_at, updated_at FROM category";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $category = $statement->fetchAll();

        foreach ($category as $row) {
            $category = new Category();
            $category->setCategoryId($row['category_id']);
            $category->setCategoryName($row['category_name']);
            $category->setCreatedAt($row['created_at']);
            $category->setUpdatedAt($row['updated_at']);

            $result[] = $category;
        }
        return $result;
    }
}