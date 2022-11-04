<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\User;

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
        $statement->execute([$user->username, $user->password]);
        return $user;
    }

    public function update(User $user): User
    {
        $statement = $this->connection
            ->prepare("UPDATE users SET password = ?, update_password_at = CURRENT_TIMESTAMP WHERE  username = ?");
        $statement->execute([$user->password, $user->username]);
        return $user;
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection
            ->prepare("SELECT username, password, created_at, update_password_at, online_status, last_login FROM users WHERE username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->createdAt = $row['created_at'];
                $user->updatePasswordAt = $row['update_password_at'];
                $user->onlineStatus = $row['online_status'];
                $user->lastLogin = $row['last_login'];

                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteByUsername(string $username): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE username = ?");
        $statement->execute([$username]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }

}