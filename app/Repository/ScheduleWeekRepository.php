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
            ->prepare("INSERT INTO schedule_weeks(id, supply_schedules_id, date, is_done, m_id) VALUES (?,?,?,?,?)");
        $stmt->execute([$schedule->getId(), $schedule->getScheduleSupplyId(), $schedule->getDate(), $schedule->getIsDone(), $schedule->getMId()]);
        return $schedule;
    }

    public function update(ScheduleWeek $schedule): ScheduleWeek
    {
        $statement = $this->connection
            ->prepare("UPDATE schedule_weeks SET is_done = ? WHERE  id = ?");
        $statement->execute([$schedule->getIsDone(), $schedule->getId()]);
        return $schedule;
    }

// TODO karena PHP OOP itu cocok untuk desain pattern MVC maka kelompok kami memutuskan untuk menggunakan konsep MVC pada projek ini
    public function findById(string $id): ?ScheduleWeek
    {
        $statement = $this->connection
            ->prepare("SELECT id, supply_schedules_id, is_done, date, m_id FROM schedule_weeks WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $schedule = new ScheduleWeek();
                $schedule->setId($row['id']);
                $schedule->setScheduleSupplyId($row['supply_schedules_id']);
                $schedule->setDate($row['date']);
                $schedule->setIsDone($row['is_done']);

                return $schedule;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findScheduleSupplyId(string $scheduleSupplyId): array
    {
        $sql = "SELECT id, supply_schedules_id, is_done, date, m_id FROM schedule_weeks WHERE supply_schedules_id = ? ORDER BY date";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$scheduleSupplyId]);

        $result = [];

        $scheduleWeeks = $statement->fetchAll();

        foreach ($scheduleWeeks as $row) {
            $scheduleWeek = new ScheduleWeek();
            $scheduleWeek->setId($row['id']);
            $scheduleWeek->setScheduleSupplyId($row['supply_schedules_id']);
            $scheduleWeek->setIsDone($row['is_done']);
            $scheduleWeek->setDate($row['date']);
            $scheduleWeek->setMId($row['m_id']);

            $result[] = $scheduleWeek;
        }
        return $result;
    }
}