<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\RelationModel\UserUserDetailUserRole;
use Subjig\Report\Model\User;

class UserRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection
            ->prepare("INSERT INTO users(username, password, created_at) VALUES (?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$user->getUsername(), $user->getPassword()]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection
            ->prepare("UPDATE users SET password = ?, update_password_at = CURRENT_TIMESTAMP WHERE  username = ?");
        $statement->execute([$user->getPassword(), $user->getUsername()]);
        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection
            ->prepare("SELECT username, password, created_at, update_password_at FROM users WHERE username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->setUsername($row['username']);
                $user->setPassword($row['password']);
                $user->setCreatedAt($row['created_at']);
                $user->setUpdatePasswordAt($row['update_password_at']);

                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): array
    {
        $sql = "SELECT username, password, created_at, update_password_at FROM users";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $user = $statement->fetchAll();

        foreach ($user as $row) {
            $user = new User();
            $user->setUsername($row['username']);
            $user->setUpdatePasswordAt($row['update_password_at']);
            $user->setCreatedAt($row['create_at']);

            $result[] = $user;
        }
        return $result;
    }

    public function deleteByUsername(string $username): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE username = ?");
        $statement->execute([$username]);
    }

    public function userData(int $role_id): array
    {
        $sql = "SELECT usr.username,
       usr_d.full_name,
       usr_r.user_role_name,
       usr.created_at,
       usr_d.updated_at,
       usr.update_password_at
FROM user_details as usr_d
         INNER JOIN users as usr ON usr.username = usr_d.username
         INNER JOIN user_roles as usr_r ON usr_r.id = usr_d.role_id
WHERE usr_r.id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$role_id]);

        $result = [];
        $user = $statement->fetchAll();

        foreach ($user as $row) {
            $userData = new UserUserDetailUserRole();
            $userData->setUsername($row['username']);
            $userData->setFullName($row['full_name']);
            $userData->setRoleName($row['user_role_name']);
            $userData->setCreatedAt($row['created_at']);
            $userData->setUserDetailUpdatedAt($row['updated_at']);
            $userData->setUserUpdatePasswordAt($row['update_password_at']);

            $result[] = $userData;
        }

        return $result;
    }
}