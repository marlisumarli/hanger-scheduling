<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\RelationModel\SupplyScheduleHangerTypeScheduleWeek;
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
    public function findById(string $id): ?ScheduleWeek
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

    /**
     * @param string $id
     * @return array
     *
     * Data digunakan di @app\App\Controler\AdminScheduleSupplyController.php, @app\App\Controler\AdminSupplyController.php
     *
     */
    public function data(string $id): array
    {
        $sql = "SELECT
    schedule_w.id AS schedule_week_id,
    schedule_supply.month,
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
        $statement->execute([$id]);

        $result = [];

        $schedulesSubjig = $statement->fetchAll();

        foreach ($schedulesSubjig as $row) {

            $scheduleSubjig = new SupplyScheduleHangerTypeScheduleWeek();
            $scheduleSubjig->setScheduleWeekId($row['schedule_week_id']);
            $scheduleSubjig->setMId($row['m_id']);
            $scheduleSubjig->setDate($row['date']);
            $scheduleSubjig->setIsImplemented($row['is_implemented']);
            $scheduleSubjig->setSupplyId($row['supply_id']);
            $result[] = $scheduleSubjig;
        }
        return $result;
    }
}