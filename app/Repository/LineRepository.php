<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Model\Line;

class LineRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Line $line): Line
    {
        $statement = $this->connection
            ->prepare("INSERT INTO supply_lines(supply_id, subjig_id, jumlah_line_a, jumlah_line_b, jumlah_line_c, target_set, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $statement->execute([$line->supply_id, $line->subjig_id, $line->jumlah_line_a, $line->jumlah_line_b, $line->jumlah_line_c, $line->target_set, $line->total]);
        return $line;
    }

    public function update(Line $line): Line
    {
        $statement = $this->connection
            ->prepare("UPDATE supply_lines SET jumlah_line_a = ?, jumlah_line_b = ?, jumlah_line_c = ?, target_set = ?, total = ?  WHERE  id = ?");
        $statement->execute([$line->jumlah_line_a, $line->jumlah_line_b, $line->jumlah_line_c, $line->target_set, $line->total, $line->id]);
        return $line;
    }

    public function findById(string $id): ?Line
    {
        $statement = $this->connection->prepare("SELECT supply_id, subjig_id, jumlah_line_a, jumlah_line_b, jumlah_line_c, target_set, total FROM supply_lines WHERE supply_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $line = new Line();
                $line->supply_id = $row['supply_id'];
                $line->jumlah_line_a = $row['jumlah_line_a'];
                $line->jumlah_line_b = $row['jumlah_line_b'];
                $line->jumlah_line_c = $row['jumlah_line_c'];
                $line->target_set = $row['target_set'];
                $line->total = $row['total'];
                return $line;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }
}