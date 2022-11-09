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
            ->prepare("SELECT username, password, created_at, update_password_at, last_login FROM users WHERE username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->username = $row['username'];
                $user->password = $row['password'];
                $user->created_at = $row['created_at'];
                $user->update_password_at = $row['update_password_at'];
                $user->last_login = $row['last_login'];

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
        $sql = "SELECT username, password, created_at, update_password_at, last_login FROM users";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $user = $statement->fetchAll();

        foreach ($user as $row) {
            $user = new User();
            $user->setUsername($row['username']);
            $user->setLastLogin($row['last_login']);
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

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from users");
    }

}