<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\UserRole;

class UserRoleRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(UserRole $userRole): UserRole
    {
        $statement = $this->connection
            ->prepare("INSERT INTO user_roles(id, name, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $statement->execute([$userRole->roleId, $userRole->name]);
        return $userRole;
    }

    public function update(UserRole $userRole): UserRole
    {
        $statement = $this->connection
            ->prepare("UPDATE user_roles SET name = ? ,updated_at = CURRENT_TIMESTAMP WHERE  id = ?");
        $statement->execute([$userRole->name, $userRole->roleId]);
        return $userRole;
    }

    public function findById(int $id): ?UserRole
    {
        $statement = $this->connection->prepare("SELECT id, name, created_at, updated_at FROM user_roles WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $userRole = new UserRole();
                $userRole->roleId = $row['id'];
                $userRole->name = $row['name'];
                $userRole->createdAt = $row['created_at'];
                $userRole->updatedAt = $row['updated_at'];
                return $userRole;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(int $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM user_roles WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM user_roles");
    }

    public function findAll(): array
    {
        $sql = "SELECT id, name, created_at, updated_at FROM user_roles";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $roleId = $statement->fetchAll();

        foreach ($roleId as $row) {
            $role = new UserRole();
            $role->setRoleId($row['id']);
            $role->setName($row['name']);
            $role->setCreatedAt($row['created_at']);
            $role->setUpdatedAt($row['updated_at']);

            $result[] = $role;
        }
        return $result;
    }
}