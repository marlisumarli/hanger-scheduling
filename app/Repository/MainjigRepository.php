<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Mainjig;

class MainjigRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Mainjig $mainjig): Mainjig
    {
        $statement = $this->connection->prepare("INSERT INTO mainjig(mainjig_id, mainjig_name, mainjig_qty) VALUES (?,?,?)");
        $statement->execute([$mainjig->mainjig_id, $mainjig->mainjig_name, $mainjig->mainjig_qty]);
        return $mainjig;
    }

    public function update(Mainjig $mainjig): Mainjig
    {
        $statement = $this->connection
            ->prepare("UPDATE mainjig SET mainjig_name = ?, mainjig_qty = ? WHERE  mainjig_id = ?");
        $statement->execute([$mainjig->mainjig_name, $mainjig->mainjig_qty, $mainjig->mainjig_id]);
        return $mainjig;
    }

    public function findById(string $id): ?Mainjig
    {
        $statement = $this->connection->prepare("SELECT mainjig_id, mainjig_name, mainjig_qty FROM mainjig WHERE mainjig_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {

                $mainjig = new Mainjig();
                $mainjig->mainjig_id = $row['mainjig_id'];
                $mainjig->mainjig_name = $row['mainjig_name'];
                $mainjig->mainjig_qty = $row['mainjig_qty'];

                return $mainjig;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM mainjig WHERE mainjig_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM mainjig");
    }
}