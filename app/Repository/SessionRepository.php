<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Session;

class SessionRepository extends Session
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $session): Session
    {
        $statement = $this->connection
            ->prepare("INSERT INTO sessions(session_id, username)  VALUES (?, ?)");
        $statement->execute([$session->session_id, $session->username]);
        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT session_id, username FROM sessions WHERE session_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $session = new Session();
                $session->session_id = $row['session_id'];
                $session->username = $row['username'];
                return $session;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE session_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM sessions");
    }
}