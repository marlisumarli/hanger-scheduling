<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\UserRole;

class UserRoleRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(UserRole $userRole): UserRole
    {
        $statement = $this->connection
            ->prepare("INSERT INTO user_roles(id, role_name) VALUES (?, ?)");
        $statement->execute([$userRole->getId(), $userRole->getRoleName()]);
        return $userRole;
    }

    public function findById(int $id): ?UserRole
    {
        $statement = $this->connection->prepare("SELECT id, role_name FROM user_roles WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $userRole = new UserRole();
                $userRole->setId($row['id']);
                $userRole->setRoleName($row['role_name']);

                return $userRole;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): array
    {
        $sql = "SELECT id, role_name FROM user_roles ORDER BY id";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        try {
            $roleId = $statement->fetchAll();

            foreach ($roleId as $row) {
                $role = new UserRole();
                $role->setId($row['id']);
                $role->setRoleName($row['role_name']);

                $result[] = $role;
            }
            return $result;

        } finally {
            $statement->closeCursor();
        }
    }
}