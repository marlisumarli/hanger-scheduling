<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\ScheduleMCategory;

class ScheduleMCategoryRepository
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
        $stmt = $this->connection->prepare("SELECT id FROM schedule_m_categories");
        $stmt->execute();

        $result = [];

        $type = $stmt->fetchAll();

        foreach ($type as $row) {
            $type = new ScheduleMCategory();
            $type->setId($row['id']);

            $result[] = $type;
        }
        return $result;
    }
}