<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\JoinK2F;
use Subjig\Report\Entity\Supply;

class SupplyRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Supply $supply): Supply
    {
        $statement = $this->connection
            ->prepare("INSERT INTO supplies(supply_id, supply_date) VALUES (?, ?)");
        $statement->execute([$supply->supply_id, $supply->supply_date]);
        return $supply;
    }

    public function update(Supply $supply): Supply
    {
        $statement = $this->connection
            ->prepare("UPDATE supplies SET supply_id = ?, supply_date = ? WHERE  supply_id = ?");
        $statement->execute([$supply->supply_id, $supply->supply_date, $supply->supply_id]);
        return $supply;
    }

    public function findById(string $id): ?Supply
    {
        $statement = $this->connection->prepare("SELECT supply_id, supply_date FROM supplies WHERE supply_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $supply = new Supply();
                $supply->supply_id = $row['supply_id'];
                $supply->supply_date = $row['supply_date'];
                return $supply;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM supplies WHERE supply_id = ?");
        $statement->execute([$id]);
    }

    public function findAll(): array
    {
        $sql = "SELECT supply_id, supply_date FROM supplies ORDER BY supply_id";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $result = [];

        $allSupply = $statement->fetchAll();

        foreach ($allSupply as $row) {
            $supply = new Supply();
            $supply->setSupplyId($row['supply_id']);
            $supply->setSupplyDate($row['supply_date']);

            $result[] = $supply;
        }
        return $result;
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM supplies");
    }

    public function supplyK2f(string $supplyId): array
    {
        $sql = "SELECT supply.supply_date, k2f.id, k2f.k2f_name, k2f.k2f_qty, k2f.k2f_target, line.id, line.jumlah_line_a, line.jumlah_line_b, line.jumlah_line_c, line.total
FROM supplies supply
         INNER JOIN supply_lines line ON line.supply_id = supply.supply_id
         INNER JOIN k2fs k2f on line.subjig_id = k2f.k2f_id
WHERE supply.supply_id = ?";

        $statement = $this->connection->prepare($sql);
        $statement->execute([$supplyId]);

        $result = [];
        $supplies = $statement->fetchAll();

        foreach ($supplies as $row) {
            $supplyK2F = new JoinK2F();
            $supplyK2F->setSupplyDate($row['supply_date']);
            $supplyK2F->setId($row['id']);
            $supplyK2F->setK2fName($row['k2f_name']);
            $supplyK2F->setK2fQty($row['k2f_qty']);
            $supplyK2F->setK2fTarget($row['k2f_target']);
            $supplyK2F->setJumlahId($row['id']);
            $supplyK2F->setJumlahLineA($row['jumlah_line_a']);
            $supplyK2F->setJumlahLineB($row['jumlah_line_b']);
            $supplyK2F->setJumlahLineC($row['jumlah_line_c']);
            $supplyK2F->setTotal($row['total']);

            $result[] = $supplyK2F;
        }

        return $result;
    }
}