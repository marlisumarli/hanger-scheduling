<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\Session;

class SessionRepository
{

    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $session): Session
    {
        $statement = $this->connection
            ->prepare("INSERT INTO sessions(id, username)  VALUES (?, ?)");
        $statement->execute([$session->getId(), $session->getUsername()]);
        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT id, username FROM sessions WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $session = new Session();
                $session->setId($row['id']);
                $session->setUsername($row['username']);
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
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }
}