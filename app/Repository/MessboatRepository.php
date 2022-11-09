<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\Messboat;

class MessboatRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Messboat $messboat): Messboat
    {
        $statement = $this->connection->prepare("INSERT INTO messboat(messboat_id, messboat_name, messboat_qty) VALUES (?,?,?)");
        $statement->execute([$messboat->messboat_id, $messboat->messboat_name, $messboat->messboat_qty]);
        return $messboat;
    }

    public function update(Messboat $messboat): Messboat
    {
        $statement = $this->connection
            ->prepare("UPDATE messboat SET messboat_name = ?, messboat_qty = ? WHERE  messboat_id = ?");
        $statement->execute([$messboat->messboat_name, $messboat->messboat_qty, $messboat->messboat_id]);
        return $messboat;
    }

    public function findById(string $id): ?Messboat
    {
        $statement = $this->connection->prepare("SELECT messboat_id, messboat_name, messboat_qty FROM messboat WHERE messboat_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {

                $messboat = new Messboat();
                $messboat->messboat_id = $row['messboat_id'];
                $messboat->messboat_name = $row['messboat_name'];
                $messboat->messboat_qty = $row['messboat_qty'];

                return $messboat;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM messboat WHERE messboat_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM messboat");
    }
}