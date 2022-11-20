<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\SubjigJoinSupply;
use Subjig\Report\Model\Supply;

class SupplyRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Supply $supply): Supply
    {
        $statement = $this->connection
            ->prepare("INSERT INTO supplies(supply_id, type_id, supply_date, target_set) VALUES (?, ?, ?, ?)");
        $statement->execute([$supply->getSupplyId(), $supply->getTypeId(), $supply->getSupplyDate(), $supply->getTargetSet()]);
        return $supply;
    }

    public function update(Supply $supply): Supply
    {
        $statement = $this->connection
            ->prepare("UPDATE supplies SET supply_id = ?, supply_date = ?, target_set = ? WHERE  supply_id = ?");
        $statement->execute([$supply->getSupplyId(), $supply->getSupplyDate(), $supply->getTargetSet(), $supply->getSupplyId()]);
        return $supply;
    }

    public function findById(string $id): ?Supply
    {
        $statement = $this->connection->prepare("SELECT supply_id, type_id, supply_date, target_set FROM supplies WHERE supply_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $supply = new Supply();
                $supply->setSupplyId($row['supply_id']);
                $supply->setTypeId($row['type_id']);
                $supply->setSupplyDate($row['supply_date']);
                $supply->setTargetSet($row['target_set']);
                return $supply;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM supplies WHERE supply_id = ?");
        $statement->execute([$id]);
    }

    public function findAll(string $id): array
    {
        $sql = "SELECT supply_id, supply.type_id, supply_date, target_set
FROM supplies supply
         INNER JOIN types type ON type.type_id = supply.type_id
where supply.type_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        $result = [];

        $allSupply = $statement->fetchAll();

        foreach ($allSupply as $row) {
            $supply = new Supply();
            $supply->setSupplyId($row['supply_id']);
            $supply->setTypeId($row['type_id']);
            $supply->setSupplyDate($row['supply_date']);
            $supply->setTargetSet($row['target_set']);

            $result[] = $supply;
        }
        return $result;
    }

    public function allSupplyLine(string $type): array
    {
        $sql = "SELECT
       supply.supply_date,
       supply.target_set,
       order_number,
       subjig_name,
       subjig_qty,
       line.id,
       jumlah_line_a,
       jumlah_line_b,
       jumlah_line_c,
       total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.supply_id
         INNER JOIN subjigs subjig on line.subjig_id = subjig.subjig_id
         INNER JOIN types type on supply.type_id = type.type_id
WHERE supply.supply_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$type]);

        $supplies = $statement->fetchAll();

        $result = [];
        foreach ($supplies as $row) {
            $supplySubjig = new SubjigJoinSupply();
            $supplySubjig->setSupplyDate($row['supply_date']);
            $supplySubjig->setSupplyTarget($row['target_set']);
            $supplySubjig->setOrderId($row['order_number']);
            $supplySubjig->setSubjigName($row['subjig_name']);
            $supplySubjig->setSubjigQty($row['subjig_qty']);
            $supplySubjig->setSupplyLineId($row['id']);
            $supplySubjig->setLineTarget($row['target_set']);
            $supplySubjig->setJumlahLineA($row['jumlah_line_a']);
            $supplySubjig->setJumlahLineB($row['jumlah_line_b']);
            $supplySubjig->setJumlahLineC($row['jumlah_line_c']);
            $supplySubjig->setTotal($row['total']);

            $result[] = $supplySubjig;
        }
        return $result;
    }
}