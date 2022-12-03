<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\HangerType;

class HangerTypeRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(HangerType $type): HangerType
    {
        $stmt = $this->connection->prepare("INSERT INTO hanger_types(id, qty) VALUES (?, ?)");
        $stmt->execute([$type->getId(), $type->getQty()]);

        return $type;
    }

    public function update(HangerType $type): HangerType
    {
        if ($type->getNewId() !== null) {
            $stmt = $this->connection
                ->prepare("UPDATE hanger_types SET id = ? WHERE  id = ?");
            $stmt->execute([$type->getNewId(), $type->getId()]);
        } elseif ($type->getQty() !== null) {
            $stmt = $this->connection
                ->prepare("UPDATE hanger_types SET qty = ? WHERE  id = ?");
            $stmt->execute([$type->getQty(), $type->getId()]);
        }
        return $type;
    }

    public function findById(string $id): ?HangerType
    {
        $stmt = $this->connection->prepare("SELECT id, qty FROM hanger_types WHERE id = ?");
        $stmt->execute([$id]);

        try {
            if ($row = $stmt->fetch()) {
                $type = new HangerType();
                $type->setId($row['id']);
                $type->setQty($row['qty']);

                return $type;
            } else {
                return null;
            }
        } finally {
            $stmt->closeCursor();
        }
    }

    public function findAll(): array
    {
        $stmt = $this->connection->prepare("SELECT id, qty FROM hanger_types");
        $stmt->execute();

        $result = [];

        $type = $stmt->fetchAll();

        foreach ($type as $row) {
            $type = new HangerType();
            $type->setId($row['id']);
            $type->setQty($row['qty']);

            $result[] = $type;
        }
        return $result;
    }
}