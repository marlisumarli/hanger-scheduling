<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\UserDetail;

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
            ->prepare("INSERT INTO user_details(user_detail_id, username, full_name, role_id ) VALUES (?,?,?,?)");
        $statement->execute([$userDetail->getUserDetailId(), $userDetail->getUsername(), $userDetail->getFullName(), $userDetail->getRoleId()]);
        return $userDetail;
    }

    public function update(UserDetail $userDetail): UserDetail
    {
        $statement = $this->connection
            ->prepare("UPDATE user_details SET full_name = ?, role_id = ?, updated_at = CURRENT_TIMESTAMP WHERE username = ?");
        $statement->execute([$userDetail->getFullName(), $userDetail->getRoleId(), $userDetail->getUsername()]);
        return $userDetail;
    }

    public function findByUsername(string $username): ?UserDetail
    {
        $statement = $this->connection
            ->prepare("SELECT user_detail_id, username, full_name, role_id, updated_at FROM user_details WHERE username = ?");
        $statement->execute([$username]);

        try {
            if ($row = $statement->fetch()) {
                $userDetail = new UserDetail();
                $userDetail->setUserDetailId($row['user_detail_id']);
                $userDetail->setUsername($row['username']);
                $userDetail->setFullName($row['full_name']);
                $userDetail->setRoleId($row['role_id']);
                $userDetail->setUpdatedAt($row['updated_at']);
                return $userDetail;
            } else {
                return null;
            }

        } finally {
            $statement->closeCursor();
        }
    }
}
