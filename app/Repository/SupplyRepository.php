<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\Supply;

class SupplyRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
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

    public function findAll(string $hangerTypeId): array
    {
        $sql = "SELECT id, hanger_type_id, schedule_week_id, target_set FROM supplies WHERE hanger_type_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$hangerTypeId]);

        $result = [];

        $supplies = $statement->fetchAll();

        foreach ($supplies as $row) {
            $supply = new Supply();
            $supply->setId($row['id']);
            $supply->setHangerTypeId($row['hanger_type_id']);
            $supply->setScheduleWeekId($row['schedule_week_id']);
            $supply->setTargetSet($row['target_set']);

            $result[] = $supply;
        }
        return $result;
    }

    public function findScheduleWeekId(string $scheduleWeekId): array
    {
        $sql = "SELECT id, hanger_type_id, schedule_week_id, target_set FROM supplies WHERE schedule_week_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$scheduleWeekId]);

        $result = [];

        $supplies = $statement->fetchAll();

        foreach ($supplies as $row) {
            $supply = new Supply();
            $supply->setId($row['id']);
            $supply->setHangerTypeId($row['hanger_type_id']);
            $supply->setScheduleWeekId($row['schedule_week_id']);
            $supply->setTargetSet($row['target_set']);

            $result[] = $supply;
        }
        return $result;
    }
}