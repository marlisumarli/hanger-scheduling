<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\User;

class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection
            ->prepare("INSERT INTO users(username, password, full_name, role_id) VALUES (?,?,?,?)");
        $statement->execute([$user->getUsername(), $user->getPassword(), $user->getFullName(), $user->getRoleId()]);
        return $user;
    }

    public function update(User $user): void
    {
        if ($user->getRoleId() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE users SET role_id = ?  WHERE  username = ?");
            $statement->execute([$user->getRoleId(), $user->getUsername()]);
        } elseif ($user->getFullName() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE users SET full_name = ?  WHERE  username = ?");
            $statement->execute([$user->getFullName(), $user->getUsername()]);
        } elseif ($user->getPassword() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE users SET password = ?  WHERE  username = ?");
            $statement->execute([$user->getPassword(), $user->getUsername()]);
        } elseif ($user->getLastLogin() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE users SET last_login = ?  WHERE  username = ?");
            $statement->execute([$user->getLastLogin(), $user->getUsername()]);
        }
    }

    public function findByUsername(string $username): ?User
    {
        $statement = $this->connection
            ->prepare("SELECT username, password, full_name, role_id, last_login FROM users WHERE username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new User();
                $user->setUsername($row['username']);
                $user->setPassword($row['password']);
                $user->setFullName($row['full_name']);
                $user->setRoleId($row['role_id']);
                $user->setLastLogin($row['last_login']);
                return $user;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findRoleId(string $roleId): array
    {
        $sql = "SELECT username, password, full_name, role_id, last_login FROM users WHERE role_id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$roleId]);

        $result = [];

        try {
            $user = $statement->fetchAll();

            foreach ($user as $row) {
                $user = new User();
                $user->setUsername($row['username']);
                $user->setFullName($row['full_name']);
                $user->setRoleId($row['role_id']);
                $user->setLastLogin($row['last_login']);

                $result[] = $user;
            }
            return $result;
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteByUsername(string $username): void
    {
        $statement = $this->connection->prepare("DELETE FROM users WHERE username = ?");
        $statement->execute([$username]);
    }
}