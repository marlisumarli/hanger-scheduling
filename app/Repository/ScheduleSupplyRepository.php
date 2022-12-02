<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\SupplySchedule;

class ScheduleSupplyRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(SupplySchedule $scheduleSubjig): SupplySchedule
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO supply_schedules(id, hanger_type_id, period_id, month) VALUES (?,?,?,?)");
        $stmt->execute([$scheduleSubjig->getId(), $scheduleSubjig->getHangerTypeId(), $scheduleSubjig->getPeriodId(), $scheduleSubjig->getMonth()]);
        return $scheduleSubjig;
    }

    public function findById(string $id): ?SupplySchedule
    {
        $statement = $this->connection
            ->prepare("SELECT id, hanger_type_id, period_id, month FROM supply_schedules WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $scheduleSubjig = new SupplySchedule();
                $scheduleSubjig->setId($row['id']);
                $scheduleSubjig->setHangerTypeId($row['hanger_type_id']);
                $scheduleSubjig->setPeriodId($row['period_id']);
                $scheduleSubjig->setMonth($row['month']);

                return $scheduleSubjig;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(string $type): array
    {
        $sql = "SELECT
    schedule_supply.period_id,
    schedule_supply.id,
    schedule_supply.month
FROM supply_schedules schedule_supply
         INNER JOIN hanger_types AS type ON type.id = schedule_supply.hanger_type_id
         INNER JOIN periods AS period ON period.id = schedule_supply.period_id
WHERE type.id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$type]);

        $result = [];

        $schedulesSubjig = $statement->fetchAll();

        foreach ($schedulesSubjig as $row) {
            $scheduleSubjig = new SupplySchedule();
            $scheduleSubjig->setId($row['id']);
            $scheduleSubjig->setMonth($row['month']);
            $scheduleSubjig->setPeriodId($row['period_id']);

            $result[] = $scheduleSubjig;
        }
        return $result;
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM supply_schedules WHERE id = ?");
        $statement->execute([$id]);
    }
}