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
        $statement = $this->connection->prepare("INSERT INTO tx_k1a(
                   tx_k1a_id, 
                   category_id,
                   tx_k1a_type,
                   tx_k1a_year, 
                   tx_k1a_chf,
                   tx_k1a_speedometer,
                   tx_k1a_body_r,
                   tx_k1a_body_l,
                   tx_k1a_fender,
                   tx_k1a_supply_tanggal,
                   tx_k1a_perbaikan_tanggal,
                   tx_k1a_selesai_tanggal,
                   tx_k1a_datang_tanggal,
                   tx_k1a_keterangan
                   ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $txK1A->tx_k1a_id, $txK1A->category_id, $txK1A->tx_k1a_type, $txK1A->tx_k1a_year,
            $txK1A->tx_k1a_chf, $txK1A->tx_k1a_speedometer, $txK1A->tx_k1a_body_r, $txK1A->tx_k1a_body_l, $txK1A->tx_k1a_fender,
            $txK1A->tx_k1a_supply_tanggal, $txK1A->tx_k1a_perbaikan_tanggal, $txK1A->tx_k1a_selesai_tanggal, $txK1A->tx_k1a_datang_tanggal, $txK1A->tx_k1a_keterangan
        ]);
        return $txK1A;
    }

    public function update(TxK1A $txK1A): TxK1A
    {
        $statement = $this->connection->prepare("UPDATE tx_k1a SET 
                  category_id = ?, 
                   tx_k1a_chf = ?,
                   tx_k1a_speedometer = ?,
                   tx_k1a_body_r = ?,
                   tx_k1a_body_l = ?,
                   tx_k1a_fender = ?,
                   tx_k1a_supply_tanggal = ?,
                   tx_k1a_perbaikan_tanggal = ?,
                   tx_k1a_selesai_tanggal = ?,
                   tx_k1a_datang_tanggal = ?,
                   updated_at = CURRENT_TIMESTAMP
              WHERE tx_k1a_id = ?");

        $statement->execute([
            $txK1A->category_id,
            $txK1A->tx_k1a_chf, $txK1A->tx_k1a_speedometer, $txK1A->tx_k1a_body_r, $txK1A->tx_k1a_body_l, $txK1A->tx_k1a_fender,
            $txK1A->tx_k1a_supply_tanggal, $txK1A->tx_k1a_perbaikan_tanggal, $txK1A->tx_k1a_selesai_tanggal, $txK1A->tx_k1a_datang_tanggal,
            $txK1A->tx_k1a_id
        ]);
        return $txK1A;
    }

    public function findById(string $id): ?TxK1A
    {
        $statement = $this->connection->prepare("SELECT tx_k1a_id, 
                   category_id,
                   tx_k1a_type,
                   tx_k1a_year, 
                   tx_k1a_chf,
                   tx_k1a_speedometer,
                   tx_k1a_body_r,
                   tx_k1a_body_l,
                   tx_k1a_fender,
                   tx_k1a_supply_tanggal,
                   tx_k1a_perbaikan_tanggal,
                   tx_k1a_selesai_tanggal,
                   tx_k1a_pic,
                   tx_k1a_datang_tanggal,
                   tx_k1a_keterangan ,
                   updated_at FROM tx_k1a WHERE tx_k1a_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $txK1A = new TxK1A();
                $txK1A->tx_k1a_id = $row['tx_k1a_id'];
                $txK1A->category_id = $row['category_id'];
                $txK1A->tx_k1a_type = $row['tx_k1a_type'];
                $txK1A->tx_k1a_year = $row['tx_k1a_year'];
                $txK1A->tx_k1a_chf = $row['tx_k1a_chf'];
                $txK1A->tx_k1a_speedometer = $row['tx_k1a_speedometer'];
                $txK1A->tx_k1a_body_r = $row['tx_k1a_body_r'];
                $txK1A->tx_k1a_body_l = $row['tx_k1a_body_l'];
                $txK1A->tx_k1a_fender = $row['tx_k1a_fender'];
                $txK1A->tx_k1a_supply_tanggal = $row['tx_k1a_supply_tanggal'];
                $txK1A->tx_k1a_perbaikan_tanggal = $row['tx_k1a_perbaikan_tanggal'];
                $txK1A->tx_k1a_selesai_tanggal = $row['tx_k1a_selesai_tanggal'];
                $txK1A->tx_k1a_pic = $row['tx_k1a_pic'];
                $txK1A->tx_k1a_datang_tanggal = $row['tx_k1a_datang_tanggal'];
                $txK1A->tx_k1a_keterangan = $row['tx_k1a_keterangan'];
                $txK1A->updated_at = $row['updated_at'];
                return $txK1A;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM tx_k1a WHERE tx_k1a_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM tx_k1a");
    }
}