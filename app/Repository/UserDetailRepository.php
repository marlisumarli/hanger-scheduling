<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\UserDetail;

class UserDetailRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }


    public function save(UserDetail $userDetail): UserDetail
    {
        $statement = $this->connection
            ->prepare("INSERT INTO user_details(id, credential, full_name, role_id ) VALUES (?,?,?,?)");
        $statement->execute([$userDetail->id, $userDetail->credential, $userDetail->fullName, $userDetail->roleId]);
        return $userDetail;
    }

    public function update(UserDetail $userDetail): UserDetail
    {
        $statement = $this->connection
            ->prepare("UPDATE user_details SET full_name = ?, role_id = ?, updated_at = CURRENT_TIMESTAMP WHERE credential = ?");
        $statement->execute([$userDetail->fullName, $userDetail->roleId, $userDetail->credential]);
        return $userDetail;
    }

    public function findByUsername(string $credential): ?UserDetail
    {
        $statement = $this->connection
            ->prepare("SELECT id, credential, full_name, role_id, updated_at FROM user_details WHERE credential = ?");
        $statement->execute([$credential]);

        try {
            if ($row = $statement->fetch()) {
                $userDetail = new UserDetail();
                $userDetail->id = $row['id'];
                $userDetail->credential = $row['credential'];
                $userDetail->fullName = $row['full_name'];
                $userDetail->roleId = $row['role_id'];
                $userDetail->updatedAt = $row['updated_at'];
                return $userDetail;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM user_details");
    }
}
