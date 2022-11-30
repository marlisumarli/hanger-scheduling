<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\RelationModel\HangerSupplyLineSupply;
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
            ->prepare("INSERT INTO supplies(id,hanger_type_id, schedule_week_id, target_set) VALUES (?,?,?,?)");
        $statement->execute([$supply->getId(), $supply->getHangerTypeId(), $supply->getScheduleWeekId(), $supply->getTargetSet()]);
        return $supply;
    }

    public function update(Supply $supply): Supply
    {
        $statement = $this->connection
            ->prepare("UPDATE supplies SET target_set = ? WHERE  id = ?");
        $statement->execute([$supply->getTargetSet(), $supply->getId()]);
        return $supply;
    }

    public function findById(string $id): ?Supply
    {
        $statement = $this->connection->prepare("SELECT id, hanger_type_id, schedule_week_id, target_set FROM supplies WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $supply = new Supply();
                $supply->setId($row['id']);
                $supply->setHangerTypeId($row['hanger_type_id']);
                $supply->setScheduleWeekId($row['schedule_week_id']);
                $supply->setTargetSet($row['target_set']);
                return $supply;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(string $id): array
    {
        $sql = "SELECT supply.id, supply.hanger_type_id, schedule_week_id, target_set
FROM supplies supply
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id
where supply.hanger_type_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        $result = [];

        $allSupply = $statement->fetchAll();

        foreach ($allSupply as $row) {
            $supply = new Supply();
            $supply->setId($row['id']);
            $supply->setHangerTypeId($row['hanger_type_id']);
            $supply->setScheduleWeekId($row['schedule_week_id']);
            $supply->setTargetSet($row['target_set']);

            $result[] = $supply;
        }
        return $result;
    }

    public function data(string $id): array
    {
        $sql = "SELECT
       supply.id AS supply_id,
       supply.target_set,
       order_number,
       hanger_name,
       hanger_qty,
       line.id AS line_id,
       line_a,
       line_b,
       line_c,
       total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.id
         INNER JOIN hangers hanger ON hanger.id = line.hanger_id
         INNER JOIN hanger_types type ON type.id = supply.hanger_type_id
WHERE hanger.id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        $supplies = $statement->fetchAll();

        $result = [];
        foreach ($supplies as $row) {
            $supplySubjig = new HangerSupplyLineSupply();
            $supplySubjig->setTargetSet($row['target_set']);
            $supplySubjig->setOrderNumber($row['order_number']);
            $supplySubjig->setHangerName($row['hanger_name']);
            $supplySubjig->setHangerQty($row['hanger_qty']);
            $supplySubjig->setSupplyLineId($row['line_id']);
            $supplySubjig->setTargetSet($row['target_set']);
            $supplySubjig->setLineA($row['line_a']);
            $supplySubjig->setLineB($row['line_b']);
            $supplySubjig->setLineC($row['line_c']);
            $supplySubjig->setTotal($row['total']);

            $result[] = $supplySubjig;
        }
        return $result;
    }
}