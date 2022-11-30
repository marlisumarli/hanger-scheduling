<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\RelationModel\SupplyScheduleWeek;
use Subjig\Report\Model\ScheduleWeek;

class ScheduleWeekRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(ScheduleWeek $schedule): ScheduleWeek
    {
        $stmt = $this->connection
            ->prepare("INSERT INTO schedule_weeks(id, supply_schedules_id, date, is_implemented, m_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$schedule->getId(), $schedule->getScheduleSupplyId(), $schedule->getDate(), $schedule->getIsImplemented(), $schedule->getMId()]);
        return $schedule;
    }

    public function update(ScheduleWeek $schedule): ScheduleWeek
    {
        $statement = $this->connection
            ->prepare("UPDATE schedule_weeks SET is_implemented = ? WHERE  id = ?");
        $statement->execute([$schedule->getIsImplemented(), $schedule->getId()]);
        return $schedule;
    }

// TODO karena PHP OOP itu cocok untuk desain pattern MVC maka kelompok kami memutuskan untuk menggunakan konsep MVC pada projek ini
    public function findById(int $id): ?ScheduleWeek
    {
        $statement = $this->connection
            ->prepare("SELECT id, supply_schedules_id, is_implemented, date, m_id FROM schedule_weeks WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $schedule = new ScheduleWeek();
                $schedule->setId($row['id']);
                $schedule->setScheduleSupplyId($row['supply_schedules_id']);
                $schedule->setDate($row['date']);
                $schedule->setIsImplemented($row['is_implemented']);

                return $schedule;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function data(string $id): array
    {
        $sql = "SELECT 
    schedule.id AS schedule_id, 
    supply.id AS supply_id, 
    schedule.date, 
    schedule.is_implemented
    FROM supplies supply
    INNER JOIN schedule_weeks AS schedule ON schedule.id = supply.schedule_week_id
    WHERE supply.hanger_type_id = ?";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$id]);

        $result = [];

        $schedules = $statement->fetchAll();

        foreach ($schedules as $row) {
            $schedule = new SupplyScheduleWeek();
            $schedule->setScheduleId($row['schedule_id']);
            $schedule->setSupplyId($row['supply_id']);
            $schedule->setDate($row['date']);
            $schedule->setIsImplemented($row['is_implemented']);

            $result[] = $schedule;
        }
        return $result;
    }
}