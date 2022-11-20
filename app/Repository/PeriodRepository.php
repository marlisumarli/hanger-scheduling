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

    public function save(Period $period): Period
    {
        $stmt = $this->connection->prepare("INSERT INTO periods(year_id) VALUES (year_id)");
    }
}