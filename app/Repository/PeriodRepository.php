<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\Period;

class PeriodRepository
{
    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("SELECT id, created_at FROM periods ORDER BY id DESC");
        $stmt->execute();

        $result = [];

        $periods = $stmt->fetchAll();

        foreach ($periods as $row) {
            $period = new Period();
            $period->setId($row['id']);
            $period->setCreatedAt($row['created_at']);

            $result[] = $period;
        }
        return $result;
    }
}