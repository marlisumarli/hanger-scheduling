<?php

namespace Subjig\Report\Repository;

use Subjig\Report\Entity\TxK2F;

class TxK2FRepository
{
    private \PDO $connection;


    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(TxK2F $txK2F): TxK2F
    {
        $statement = $this->connection->prepare("INSERT INTO tx_k2f(
                   id, 
                   category_code,
                   type,
                   year, 
                   speedometer_a,
                   speedometer_b,
                   ring_speedometer,
                   front_r,
                   front_l,
                   front_top,
                   fender,
                   under_rl,
                   lid_pocket,
                   body_rl,
                   center_upper,
                   rr_center,
                   center,
                   inner_upper,
                   cinner,
                   supply_tanggal,
                   perbaikan_tanggal,
                   selesai_tanggal,
                   datang_tanggal,
                   keterangan
                   ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $txK2F->id, $txK2F->categoryCode, $txK2F->type, $txK2F->year,
            $txK2F->speedometerA, $txK2F->speedometerB, $txK2F->ringSpeedometer,
            $txK2F->frontR, $txK2F->frontL, $txK2F->frontTop, $txK2F->fender, $txK2F->underRL, $txK2F->lidPocket, $txK2F->bodyRL,
            $txK2F->centerUpper, $txK2F->rrCenter, $txK2F->center, $txK2F->innerUpper, $txK2F->inner,
            $txK2F->supplyTanggal, $txK2F->perbaikanTanggal, $txK2F->selesaiTanggal, $txK2F->datangTanggal, $txK2F->keterangan
        ]);
        return $txK2F;
    }

    public function update(TxK2F $txK2F): TxK2F
    {
        $statement = $this->connection->prepare("UPDATE tx_k2f SET 
                  category_code = ?, 
                   speedometer_a = ?,
                   speedometer_b = ?,
                   ring_speedometer = ?,
                   front_r = ?,
                   front_l = ?,
                   front_top = ?,
                   fender = ?,
                   under_rl = ?,
                   lid_pocket = ?,
                   body_rl = ?,
                   center_upper = ?,
                   rr_center = ?,
                   center = ?,
                   inner_upper = ?,
                   cinner = ?,
                   supply_tanggal = ?,
                   perbaikan_tanggal = ?,
                   selesai_tanggal = ?,
                   datang_tanggal = ?,
                   updated_at = CURRENT_TIMESTAMP
              WHERE id = ?");

        $statement->execute([
            $txK2F->categoryCode,
            $txK2F->speedometerA, $txK2F->speedometerB, $txK2F->ringSpeedometer,
            $txK2F->frontR, $txK2F->frontL, $txK2F->frontTop, $txK2F->fender, $txK2F->underRL, $txK2F->lidPocket, $txK2F->bodyRL,
            $txK2F->centerUpper, $txK2F->rrCenter, $txK2F->center, $txK2F->innerUpper, $txK2F->inner,
            $txK2F->supplyTanggal, $txK2F->perbaikanTanggal, $txK2F->selesaiTanggal, $txK2F->datangTanggal,
            $txK2F->id
        ]);
        return $txK2F;
    }

    public function findById(string $id): ?TxK2F
    {
        $statement = $this->connection->prepare("SELECT id, 
                   category_code,
                   type,
                   year, 
                   speedometer_a,
                   speedometer_b,
                   ring_speedometer,
                   front_r,
                   front_l,
                   front_top,
                   fender,
                   under_rl,
                   lid_pocket,
                   body_rl,
                   center_upper,
                   rr_center,
                   center,
                   inner_upper,
                   cinner,
                   supply_tanggal,
                   perbaikan_tanggal,
                   selesai_tanggal,
                   pic,
                   datang_tanggal,
                   keterangan ,
                   updated_at FROM tx_k2f WHERE id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $txK2F = new TxK2F();
                $txK2F->id = $row['id'];
                $txK2F->categoryCode = $row['category_code'];
                $txK2F->type = $row['type'];
                $txK2F->year = $row['year'];
                $txK2F->speedometerA = $row['speedometer_a'];
                $txK2F->speedometerB = $row['speedometer_b'];
                $txK2F->ringSpeedometer = $row['ring_speedometer'];
                $txK2F->frontR = $row['front_r'];
                $txK2F->frontL = $row['front_l'];
                $txK2F->frontTop = $row['front_top'];
                $txK2F->fender = $row['fender'];
                $txK2F->underRL = $row['under_rl'];
                $txK2F->lidPocket = $row['lid_pocket'];
                $txK2F->bodyRL = $row['body_rl'];
                $txK2F->centerUpper = $row['center_upper'];
                $txK2F->rrCenter = $row['rr_center'];
                $txK2F->center = $row['center'];
                $txK2F->innerUpper = $row['inner_upper'];
                $txK2F->inner = $row['cinner'];
                $txK2F->supplyTanggal = $row['supply_tanggal'];
                $txK2F->perbaikanTanggal = $row['perbaikan_tanggal'];
                $txK2F->selesaiTanggal = $row['selesai_tanggal'];
                $txK2F->pic = $row['pic'];
                $txK2F->datangTanggal = $row['datang_tanggal'];
                $txK2F->keterangan = $row['keterangan'];
                $txK2F->updatedAt = $row['updated_at'];
                return $txK2F;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM tx_k2f WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM tx_k2f");
    }
}