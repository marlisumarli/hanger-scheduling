<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Domain\Karyawan;

class KaryawanRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Karyawan $user): Karyawan
    {
        $statement = $this->connection
            ->prepare("INSERT INTO karyawans(username, password, created_at) VALUES (?,?,CURRENT_TIMESTAMP)");
        $statement->execute([$user->username, $user->password]);
        return $user;
    }

    public function update(Karyawan $user): Karyawan
    {
        $statement = $this->connection
            ->prepare("UPDATE karyawans SET password = ?, update_password_at = CURRENT_TIMESTAMP WHERE  username = ?");
        $statement->execute([$user->password, $user->username]);
        return $user;
    }

    public function findByUsername(string $username): ?Karyawan
    {
        $statement = $this->connection
            ->prepare("SELECT username, password, created_at, update_password_at, online_status, last_login FROM karyawans WHERE username = ? ");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $user = new Karyawan();
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
        $statement = $this->connection->prepare("DELETE FROM karyawans WHERE username = ?");
        $statement->execute([$username]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE from karyawans");
    }

}