<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\RelationModel\SupplyScheduleHangerTypeScheduleWeek;
use Subjig\Report\Model\SupplySchedule;

class ScheduleSupplyRepository
{
    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(SupplySchedule $scheduleSubjig): SupplySchedule
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO supply_schedules(id, hanger_type_id, created_at) VALUES (?,?,CURRENT_TIMESTAMP)");
        $stmt->execute([$scheduleSubjig->getId(), $scheduleSubjig->getHangerTypeId()]);
        return $scheduleSubjig;
    }

    public function findById(string $id): ?SupplySchedule
    {
        $statement = $this->connection
            ->prepare("SELECT id, hanger_type_id, created_at FROM supply_schedules WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $scheduleSubjig = new SupplySchedule();
                $scheduleSubjig->setId($row['id']);
                $scheduleSubjig->setHangerTypeId($row['hanger_type_id']);
                $scheduleSubjig->setCreatedAt($row['created_at']);

                return $scheduleSubjig;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(string $id): array
    {
        $sql = "SELECT
    schedule_supply.id,
    schedule_supply.created_at
FROM supply_schedules schedule_supply
         INNER JOIN hanger_types AS type ON type.id = schedule_supply.hanger_type_id
WHERE type.id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        $result = [];

        $schedulesSubjig = $statement->fetchAll();

        foreach ($schedulesSubjig as $row) {
            $scheduleSubjig = new SupplySchedule();
            $scheduleSubjig->setId($row['id']);
            $scheduleSubjig->setCreatedAt($row['created_at']);

            $result[] = $scheduleSubjig;
        }
        return $result;
    }

    public function data(string $type): array
    {
        $sql = "SELECT
    schedule_supply.created_at AS schedule_supply_created_at,
    type.id AS type_id,
    schedule_w.id AS schedule_week_id,
    schedule_w.date,
    schedule_w.m_id,
    schedule_w.is_implemented,
    supply.id AS supply_id
FROM schedule_weeks schedule_w
         INNER JOIN supply_schedules schedule_supply ON schedule_supply.id = schedule_w.supply_schedules_id
         INNER JOIN hanger_types type ON type.id = schedule_supply.hanger_type_id
         INNER JOIN supplies supply ON supply.schedule_week_id = schedule_w.id
WHERE schedule_supply.id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$type]);

        $result = [];

        $schedulesSubjig = $statement->fetchAll();

        foreach ($schedulesSubjig as $row) {

            $scheduleSubjig = new SupplyScheduleHangerTypeScheduleWeek();
            $scheduleSubjig->setCreatedAt($row['schedule_supply_created_at']);
            $scheduleSubjig->setHangerTypeId($row['type_id']);
            $scheduleSubjig->setScheduleWeekId($row['schedule_week_id']);
            $scheduleSubjig->setMId($row['m_id']);
            $scheduleSubjig->setDate($row['date']);
            $scheduleSubjig->setIsImplemented($row['is_implemented']);
            $scheduleSubjig->setSupplyId($row['supply_id']);
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