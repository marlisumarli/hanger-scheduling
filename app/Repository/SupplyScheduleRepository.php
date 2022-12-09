<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\SupplySchedule;

class SupplyScheduleRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(SupplySchedule $supplySch): SupplySchedule
    {
        $statement = $this->connection
            ->prepare("INSERT INTO supply_schedules(id, hanger_type_id, period_id, month, is_done) VALUES (?,?,?,?,?)");
        $statement->execute([$supplySch->getId(), $supplySch->getHangerTypeId(), $supplySch->getPeriodId(), $supplySch->getMonth(), $supplySch->getIsDone()]);
        return $supplySch;
    }

    public function update(SupplySchedule $supplySch): void
    {
        $statement = $this->connection
            ->prepare("UPDATE supply_schedules SET is_done = 1 WHERE  id = ?");
        $statement->execute([$supplySch->getId()]);
    }

    public function findById(string $id): ?SupplySchedule
    {
        $statement = $this->connection
            ->prepare("SELECT id, hanger_type_id, period_id, month, is_done FROM supply_schedules WHERE id = ? ");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $supplySch = new SupplySchedule();
                $supplySch->setId($row['id']);
                $supplySch->setHangerTypeId($row['hanger_type_id']);
                $supplySch->setPeriodId($row['period_id']);
                $supplySch->setMonth($row['month']);
                $supplySch->setIsDone($row['is_done']);

                return $supplySch;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(string $type): array
    {
        $sql = "SELECT id, period_id, month, is_done FROM supply_schedules WHERE hanger_type_id = ? ORDER BY month DESC";
        $statement = $this->connection->prepare($sql);
        $statement->execute([$type]);

        $result = [];
        try {
            $suppliesSch = $statement->fetchAll();
            foreach ($suppliesSch as $row) {
                $supplySch = new SupplySchedule();
                $supplySch->setId($row['id']);
                $supplySch->setMonth($row['month']);
                $supplySch->setPeriodId($row['period_id']);
                $supplySch->setIsDone($row['is_done']);

                $result[] = $supplySch;
            }

            return $result;

        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM supply_schedules WHERE id = ?");
        $statement->execute([$id]);
    }
}