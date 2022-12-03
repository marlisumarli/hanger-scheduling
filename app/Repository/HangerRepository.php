<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\Hanger;
use Subjig\Report\Model\RelationModel\HangerHangerType;

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

    public function save(Hanger $subjig): Hanger
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO hangers(id, hanger_type_id, order_number, name, qty) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$subjig->getId(), $subjig->getHangerTypeId(), $subjig->getOrderNumber(), $subjig->getName(), $subjig->getQty()]);

        return $subjig;
    }

    public function update(Hanger $subjig): Hanger
    {
        if ($subjig->getOrderNumber() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE hangers SET order_number = ? WHERE id = ?");
            $statement->execute([$subjig->getOrderNumber(), $subjig->getId()]);
        }
        if (($subjig->getName()) !== null) {
            $statement = $this->connection
                ->prepare("UPDATE hangers SET name = ?, qty = ? WHERE id = ?");
            $statement->execute([$subjig->getName(), $subjig->getQty(), $subjig->getId()]);
        }
        return $subjig;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM hangers WHERE id = ?");
        $statement->execute([$id]);
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

        $hangers = $statement->fetchAll();

        foreach ($hangers as $row) {
            $supplyLine = new Hanger();
            $supplyLine->setId($row['id']);
            $supplyLine->setHangerTypeId($row['hanger_type_id']);
            $supplyLine->setOrderNumber($row['order_number']);
            $supplyLine->setName($row['name']);
            $supplyLine->setQty($row['qty']);

            $result[] = $supplyLine;
        }
        return $result;
    }


    /**
     * @param string $type
     * @return array
     *
     * Digunakan di file @app\App\Controler\AdminSupplyController.php
     *
     */
    public function data(string $type): array
    {
        $sql = "SELECT
                type.id AS type_id,
                subjig.id AS subjig_id,
                type.qty,
                subjig.order_number,
                subjig.name,
                subjig.qty
                FROM hangers AS subjig
                         INNER JOIN hanger_types type ON type.id = subjig.hanger_type_id
                WHERE type.id = ? ORDER BY order_number";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$type]);

        $subjigAll = $stmt->fetchAll();
        $result = [];
        foreach ($subjigAll as $row) {
            $subjig = new HangerHangerType();
            $subjig->setHangerTypeId($row['type_id']);
            $subjig->setHangerId($row['subjig_id']);
            $subjig->setHangerTypeQty($row['qty']);
            $subjig->setOrderNumber($row['order_number']);
            $subjig->setHangerName($row['name']);
            $subjig->setHangerQty($row['qty']);

            $result[] = $subjig;
        }
        return $result;
    }
}