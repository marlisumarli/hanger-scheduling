<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\Hanger;

class HangerRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Hanger $hanger): Hanger
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO hangers(id, hanger_type_id, order_number, name, qty) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$hanger->getId(), $hanger->getHangerTypeId(), $hanger->getOrderNumber(), $hanger->getName(), $hanger->getQty()]);

        return $hanger;
    }

    public function update(Hanger $hanger): Hanger
    {
        if ($hanger->getOrderNumber() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE hangers SET order_number = ? WHERE id = ?");
            $statement->execute([$hanger->getOrderNumber(), $hanger->getId()]);
        }
        if (($hanger->getName()) !== null) {
            $statement = $this->connection
                ->prepare("UPDATE hangers SET name = ?, qty = ? WHERE id = ?");
            $statement->execute([$hanger->getName(), $hanger->getQty(), $hanger->getId()]);
        }
        return $hanger;
    }

    public function findById(string $id): ?Hanger
    {
        $stmt = $this->connection->prepare("SELECT id, order_number, name, qty FROM hangers WHERE id = ?");
        $stmt->execute([$id]);

        try {
            if ($row = $stmt->fetch()) {

                $subjig = new Hanger();
                $subjig->setId($row['id']);
                $subjig->setOrderNumber($row['order_number']);
                $subjig->setName($row['name']);
                $subjig->setQty($row['qty']);

                return $subjig;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    public function findHangerTypeId(string $hangerTypeId): array
    {
        $sql = "SELECT id, hanger_type_id, order_number, name, qty FROM hangers WHERE hanger_type_id = ? ORDER BY order_number";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$hangerTypeId]);

        $result = [];

        try {
            $hangers = $statement->fetchAll();
            foreach ($hangers as $row) {

                $hanger = new Hanger();
                $hanger->setId($row['id']);
                $hanger->setHangerTypeId($row['hanger_type_id']);
                $hanger->setOrderNumber($row['order_number']);
                $hanger->setName($row['name']);
                $hanger->setQty($row['qty']);

                $result[] = $hanger;
            }
            return $result;
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM hangers WHERE id = ?");
        $statement->execute([$id]);
    }
}