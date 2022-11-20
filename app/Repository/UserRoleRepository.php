<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\UserRole;

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
            ->prepare("INSERT INTO user_roles(user_role_id, user_role_name, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $statement->execute([$userRole->getUserRoleId(), $userRole->getUserRoleName()]);
        return $userRole;
    }

    public function update(UserRole $userRole): UserRole
    {
        $statement = $this->connection
            ->prepare("UPDATE user_roles SET user_role_name = ? ,updated_at = CURRENT_TIMESTAMP WHERE  user_role_id = ?");
        $statement->execute([$userRole->getUserRoleName(), $userRole->getUserRoleId()]);
        return $userRole;
    }

    public function findById(int $id): ?UserRole
    {
        $statement = $this->connection->prepare("SELECT user_role_id, user_role_name, created_at, updated_at FROM user_roles WHERE user_role_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $userRole = new UserRole();
                $userRole->setUserRoleId($row['user_role_id']);
                $userRole->setUserRoleName($row['user_role_name']);
                $userRole->setCreatedAt($row['created_at']);
                $userRole->setUpdatedAt($row['updated_at']);
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
        $sql = "SELECT user_role_id, user_role_name, created_at, updated_at FROM user_roles";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $roleId = $statement->fetchAll();

        foreach ($roleId as $row) {
            $role = new UserRole();
            $role->setUserRoleId($row['user_role_id']);
            $role->setUserRoleName($row['user_role_name']);
            $role->setCreatedAt($row['created_at']);
            $role->setUpdatedAt($row['updated_at']);

            $result[] = $role;
        }
        return $result;
    }
}