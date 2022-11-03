<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\TxK1A;

class TxK1ARepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(TxK1A $txK1A): TxK1A
    {
        
    }
}