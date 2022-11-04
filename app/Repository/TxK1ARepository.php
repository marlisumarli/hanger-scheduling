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
                   id, 
                   category_code,
                   type,
                   year, 
                   chf,
                   spdmt,
                   body_r,
                   body_l,
                   fender,
                   supply_tanggal,
                   perbaikan_tanggal,
                   selesai_tanggal,
                   datang_tanggal,
                   keterangan
                   ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $txK1A->id, $txK1A->categoryCode, $txK1A->type, $txK1A->year,
            $txK1A->chf, $txK1A->speedometer, $txK1A->bodyR, $txK1A->bodyL, $txK1A->fender,
            $txK1A->supplyTanggal, $txK1A->perbaikanTanggal, $txK1A->selesaiTanggal, $txK1A->datangTanggal, $txK1A->keterangan
        ]);
        return $txK1A;
    }

    public function update(TxK1A $txK1A): TxK1A
    {
        $statement = $this->connection->prepare("UPDATE tx_k1a SET 
                  category_code = ?, 
                   chf = ?,
                   spdmt = ?,
                   body_r = ?,
                   body_l = ?,
                   fender = ?,
                   supply_tanggal = ?,
                   perbaikan_tanggal = ?,
                   selesai_tanggal = ?,
                   datang_tanggal = ?,
                   updated_at = CURRENT_TIMESTAMP
              WHERE id = ?");

        $statement->execute([
            $txK1A->categoryCode,
            $txK1A->chf, $txK1A->speedometer, $txK1A->bodyR, $txK1A->bodyL, $txK1A->fender,
            $txK1A->supplyTanggal, $txK1A->perbaikanTanggal, $txK1A->selesaiTanggal, $txK1A->datangTanggal,
            $txK1A->id
        ]);
        return $txK1A;
    }

    public function findById(string $id): ?TxK1A
    {
        $statement = $this->connection->prepare("SELECT id, 
                   category_code,
                   type,
                   year, 
                   chf,
                   spdmt,
                   body_r,
                   body_l,
                   fender,
                   supply_tanggal,
                   perbaikan_tanggal,
                   selesai_tanggal,
                   pic,
                   datang_tanggal,
                   keterangan ,
                   updated_at FROM tx_k1a WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $txK1A = new TxK1A();
                $txK1A->id = $row['id'];
                $txK1A->categoryCode = $row['category_code'];
                $txK1A->type = $row['type'];
                $txK1A->year = $row['year'];
                $txK1A->chf = $row['chf'];
                $txK1A->speedometer = $row['spdmt'];
                $txK1A->bodyR = $row['body_r'];
                $txK1A->bodyL = $row['body_l'];
                $txK1A->fender = $row['fender'];
                $txK1A->supplyTanggal = $row['supply_tanggal'];
                $txK1A->perbaikanTanggal = $row['perbaikan_tanggal'];
                $txK1A->selesaiTanggal = $row['selesai_tanggal'];
                $txK1A->pic = $row['pic'];
                $txK1A->datangTanggal = $row['datang_tanggal'];
                $txK1A->keterangan = $row['keterangan'];
                $txK1A->updatedAt = $row['updated_at'];
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
        $statement = $this->connection->prepare("DELETE FROM tx_k1a WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM tx_k1a");
    }
}