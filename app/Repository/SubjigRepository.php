<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\Subjig;
use Subjig\Report\Model\SubjigJoinType;
use Subjig\Report\Service\MergeSort;

class SubjigRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Subjig $subjig): Subjig
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO subjigs(subjig_id, type_id, order_number, subjig_name, subjig_qty, created_at) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt->execute([$subjig->getSubjigId(), $subjig->getTypeId(), $subjig->getOrderNumber(), $subjig->getSubjigName(), $subjig->getSubjigQty()]);

        return $subjig;
    }

    public function update(Subjig $subjig): Subjig
    {
        if ($subjig->getOrderNumber() !== null) {
            $statement = $this->connection
                ->prepare("UPDATE subjigs SET order_number = ?, updated_at = CURRENT_TIMESTAMP WHERE subjig_id = ?");
            $statement->execute([$subjig->getOrderNumber(), $subjig->getSubjigId()]);
        }
        if (($subjig->getSubjigName()) !== null) {
            $statement = $this->connection
                ->prepare("UPDATE subjigs SET subjig_name = ?, subjig_qty = ?, updated_at = CURRENT_TIMESTAMP WHERE subjig_id = ?");
            $statement->execute([$subjig->getSubjigName(), $subjig->getSubjigQty(), $subjig->getSubjigId()]);
        }
        return $subjig;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM subjigs WHERE subjig_id = ?");
        $statement->execute([$id]);
    }

    public function findById(string $id): ?Subjig
    {
        $stmt = $this->connection->prepare("SELECT subjig_id, type_id, order_number, subjig_name, subjig_qty, label, created_at, updated_at FROM subjigs WHERE subjig_id = ?");
        $stmt->execute([$id]);

        try {
            if ($row = $stmt->fetch()) {
                $subjig = new Subjig();
                $subjig->setSubjigId($row['subjig_id']);
                $subjig->setTypeId($row['type_id']);
                $subjig->setOrderNumber($row['order_number']);
                $subjig->setSubjigName($row['subjig_name']);
                $subjig->setSubjigQty($row['subjig_qty']);
                $subjig->setLabel($row['label']);
                $subjig->setCreatedAt($row['created_at']);
                $subjig->setUpdatedAt($row['updated_at']);

                return $subjig;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    public function data(string $type): array
    {
        $stmt = $this->connection->prepare("SELECT 
    type.type_qty,
    subjig.order_number,
       subjig.subjig_id,
       subjig.subjig_name,
       type.type_id,
       subjig.subjig_qty,
       subjig.created_at,
       subjig.updated_at
FROM subjigs subjig
         INNER JOIN types type ON type.type_id = subjig.type_id
WHERE type.type_id = ? ORDER BY order_number");
        $stmt->execute([$type]);

        $subjigAll = $stmt->fetchAll();
        $result = [];
        foreach ($subjigAll as $row) {
            $subjig = new SubjigJoinType();
            $subjig->setTypeQty($row['type_qty']);
            $subjig->setOrderNumber($row['order_number']);
            $subjig->setSubjigId($row['subjig_id']);
            $subjig->setSubjigName($row['subjig_name']);
            $subjig->setTypeId($row['type_id']);
            $subjig->setSubjigQty($row['subjig_qty']);
            $subjig->setCreatedAt($row['created_at']);
            $subjig->setUpdatedAt($row['updated_at']);

            $result[] = $subjig;
        }
        return $result;
    }
}