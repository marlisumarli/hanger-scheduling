<?php

namespace Subjig\Report\Repository;

use PDO;
use Subjig\Report\Model\Type;

class TypeRepository
{
    private PDO $connection;

    /**
     * @param PDO $connection
     */
    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Type $type): Type
    {
        $stmt = $this->connection->prepare("INSERT INTO types(type_id, type_qty, created_at) VALUES (?, ?, CURRENT_TIMESTAMP)");
        $stmt->execute([$type->getTypeId(), $type->getTypeQty()]);

        return $type;
    }

    public function update(Type $type): Type
    {
        if ($type->getNewTypeId() !== null) {
            $stmt = $this->connection
                ->prepare("UPDATE types SET type_id = ? WHERE  type_id = ?");
            $stmt->execute([$type->getNewTypeId(), $type->getTypeId()]);
        } elseif ($type->getTypeQty() !== null) {
            $stmt = $this->connection
                ->prepare("UPDATE types SET type_qty = ? WHERE  type_id = ?");
            $stmt->execute([$type->getTypeQty(), $type->getTypeId()]);
        }
        return $type;
    }

    public function findById(string $id): ?Type
    {
        $stmt = $this->connection->prepare("SELECT type_id, type_qty, created_at FROM types WHERE type_id = ?");
        $stmt->execute([$id]);

        try {
            if ($row = $stmt->fetch()) {
                $type = new Type();
                $type->setTypeId($row['type_id']);
                $type->setTypeQty($row['type_qty']);
                $type->setCreatedAt($row['created_at']);

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
        $stmt = $this->connection->prepare("SELECT type_id, type_qty, created_at FROM types");
        $stmt->execute();

        $result = [];

        $type = $stmt->fetchAll();

        foreach ($type as $row) {
            $type = new Type();
            $type->setTypeId($row['type_id']);
            $type->setTypeQty($row['type_qty']);
            $type->setCreatedAt($row['created_at']);

            $result[] = $type;
        }
        return $result;
    }
}