<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Join;

class JoinRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
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
         INNER JOIN user_roles as usr_r ON usr_r.user_role_id = usr_d.role_id
WHERE usr_r.user_role_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$role_id]);

        $result = [];
        $user = $statement->fetchAll();

        foreach ($user as $row) {
            $userData = new Join();
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