<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\SupplyLine;

class SupplyLineRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(SupplyLine $line): SupplyLine
    {
        $statement = $this->connection
            ->prepare("INSERT INTO supply_lines(supply_id, hanger_id, line_a, line_b, line_c, total) VALUES ( ?, ?, ?, ?, ?, ?)");
        $statement->execute([$line->getSupplyId(), $line->getHangerId(), $line->getLineA(), $line->getLineB(), $line->getLineC(), $line->getTotal()]);
        return $line;
    }

    public function update(SupplyLine $line): SupplyLine
    {
        $statement = $this->connection
            ->prepare("UPDATE supply_lines SET line_a = ?, line_b = ?, line_c = ?,  total = ?  WHERE  id = ?");
        $statement->execute([$line->getLineA(), $line->getLineB(), $line->getLineC(), $line->getTotal(), $line->getId()]);
        return $line;
    }

    public function findById(string $id): ?SupplyLine
    {
        $statement = $this->connection->prepare("SELECT supply_id, hanger_id, line_a, line_b, line_c, total FROM supply_lines WHERE supply_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $line = new SupplyLine();
                $line->setSupplyId($row['supply_id']);
                $line->setLineA($row['line_a']);
                $line->setLineB($row['line_b']);
                $line->setLineC($row['line_c']);
                $line->setTotal($row['total']);
                return $line;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findSupplyId(string $supplyId): array
    {
        $sql = "SELECT id, supply_id, hanger_id, line_a, line_b, line_c, total FROM supply_lines WHERE supply_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$supplyId]);

        $result = [];

        $supplyLines = $statement->fetchAll();

        foreach ($supplyLines as $row) {
            $supplyLine = new SupplyLine();
            $supplyLine->setId($row['id']);
            $supplyLine->setSupplyId($row['supply_id']);
            $supplyLine->setHangerId($row['hanger_id']);
            $supplyLine->setLineA($row['line_a']);
            $supplyLine->setLineB($row['line_b']);
            $supplyLine->setLineC($row['line_c']);
            $supplyLine->setTotal($row['total']);

            $result[] = $supplyLine;
        }
        return $result;
    }
}