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
                   tx_k2f_id, 
                   category_id,
                   tx_k2f_type,
                   tx_k2f_year, 
                   tx_k2f_speedometer_a,
                   tx_k2f_speedometer_b,
                   tx_k2f_ring_speedometer,
                   tx_k2f_front_r,
                   tx_k2f_front_l,
                   tx_k2f_front_top,
                   tx_k2f_fender,
                   tx_k2f_under_rl,
                   tx_k2f_lid_pocket,
                   tx_k2f_body_rl,
                   tx_k2f_center_upper,
                   tx_k2f_rr_center,
                   tx_k2f_center,
                   tx_k2f_inner_upper,
                   tx_k2f_inner,
                   tx_k2f_supply_tanggal,
                   tx_k2f_perbaikan_tanggal,
                   tx_k2f_selesai_tanggal,
                   tx_k2f_datang_tanggal,
                   tx_k2f_keterangan
                   ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute([
            $txK2F->tx_k2f_id, $txK2F->category_id, $txK2F->tx_k2f_type, $txK2F->tx_k2f_year,
            $txK2F->tx_k2f_speedometer_a, $txK2F->tx_k2f_speedometer_b, $txK2F->tx_k2f_ring_speedometer,
            $txK2F->tx_k2f_front_r, $txK2F->tx_k2f_front_l, $txK2F->tx_k2f_front_top, $txK2F->tx_k2f_fender, $txK2F->tx_k2f_under_rL,
            $txK2F->tx_k2f_lid_pocket, $txK2F->tx_k2f_body_rl, $txK2F->tx_k2f_center_upper, $txK2F->tx_k2f_rr_center, $txK2F->tx_k2f_center, $txK2F->tx_k2f_inner_upper, $txK2F->tx_k2f_inner,
            $txK2F->tx_k2f_supply_tanggal, $txK2F->tx_k2f_perbaikan_tanggal, $txK2F->tx_k2f_selesai_tanggal, $txK2F->tx_k2f_datang_tanggal, $txK2F->tx_k2f_keterangan
        ]);
        return $txK2F;
    }

    public function update(TxK2F $txK2F): TxK2F
    {
        $statement = $this->connection->prepare("UPDATE tx_k2f SET 
                  category_id = ?, 
                   tx_k2f_speedometer_a = ?,
                   tx_k2f_speedometer_b = ?,
                   tx_k2f_ring_speedometer = ?,
                   tx_k2f_front_r = ?,
                   tx_k2f_front_l = ?,
                   tx_k2f_front_top = ?,
                   tx_k2f_fender = ?,
                   tx_k2f_under_rl = ?,
                   tx_k2f_lid_pocket = ?,
                   tx_k2f_body_rl = ?,
                   tx_k2f_center_upper = ?,
                   tx_k2f_rr_center = ?,
                   tx_k2f_center = ?,
                   tx_k2f_inner_upper = ?,
                   tx_k2f_inner = ?,
                   tx_k2f_supply_tanggal = ?,
                   tx_k2f_perbaikan_tanggal = ?,
                   tx_k2f_selesai_tanggal = ?,
                   tx_k2f_datang_tanggal = ?,
                   updated_at = CURRENT_TIMESTAMP
              WHERE tx_k2f_id = ?");

        $statement->execute([
            $txK2F->category_id,
            $txK2F->tx_k2f_speedometer_a, $txK2F->tx_k2f_speedometer_b, $txK2F->tx_k2f_ring_speedometer, $txK2F->tx_k2f_front_r,
            $txK2F->tx_k2f_front_l, $txK2F->tx_k2f_front_top, $txK2F->tx_k2f_fender, $txK2F->tx_k2f_under_rL, $txK2F->tx_k2f_lid_pocket, $txK2F->tx_k2f_body_rl,
            $txK2F->tx_k2f_center_upper, $txK2F->tx_k2f_rr_center, $txK2F->tx_k2f_center, $txK2F->tx_k2f_inner_upper, $txK2F->tx_k2f_inner,
            $txK2F->tx_k2f_supply_tanggal, $txK2F->tx_k2f_perbaikan_tanggal, $txK2F->tx_k2f_selesai_tanggal, $txK2F->tx_k2f_datang_tanggal,
            $txK2F->tx_k2f_id
        ]);
        return $txK2F;
    }

    public function findById(string $id): ?TxK2F
    {
        $statement = $this->connection->prepare("SELECT tx_k2f_id, 
                   category_id,
                   tx_k2f_type,
                   tx_k2f_year, 
                   tx_k2f_speedometer_a,
                   tx_k2f_speedometer_b,
                   tx_k2f_ring_speedometer,
                   tx_k2f_front_r,
                   tx_k2f_front_l,
                   tx_k2f_front_top,
                   tx_k2f_fender,
                   tx_k2f_under_rl,
                   tx_k2f_lid_pocket,
                   tx_k2f_body_rl,
                   tx_k2f_center_upper,
                   tx_k2f_rr_center,
                   tx_k2f_center,
                   tx_k2f_inner_upper,
                   tx_k2f_inner,
                   tx_k2f_supply_tanggal,
                   tx_k2f_perbaikan_tanggal,
                   tx_k2f_selesai_tanggal,
                   tx_k2f_pic,
                   tx_k2f_datang_tanggal,
                   tx_k2f_keterangan ,
                   updated_at FROM tx_k2f WHERE tx_k2f_id = ?");
        $statement->execute([$id]);

        try {
            if ($row = $statement->fetch()) {
                $txK2F = new TxK2F();
                $txK2F->tx_k2f_id = $row['tx_k2f_id'];
                $txK2F->category_id = $row['category_id'];
                $txK2F->tx_k2f_type = $row['tx_k2f_type'];
                $txK2F->tx_k2f_year = $row['tx_k2f_year'];
                $txK2F->tx_k2f_speedometer_a = $row['tx_k2f_speedometer_a'];
                $txK2F->tx_k2f_speedometer_b = $row['tx_k2f_speedometer_b'];
                $txK2F->tx_k2f_ring_speedometer = $row['tx_k2f_ring_speedometer'];
                $txK2F->tx_k2f_front_r = $row['tx_k2f_front_r'];
                $txK2F->tx_k2f_front_l = $row['tx_k2f_front_l'];
                $txK2F->tx_k2f_front_top = $row['tx_k2f_front_top'];
                $txK2F->tx_k2f_fender = $row['tx_k2f_fender'];
                $txK2F->tx_k2f_under_rL = $row['tx_k2f_under_rL'];
                $txK2F->tx_k2f_lid_pocket = $row['tx_k2f_lid_pocket'];
                $txK2F->tx_k2f_body_rl = $row['tx_k2f_body_rl'];
                $txK2F->tx_k2f_center_upper = $row['tx_k2f_center_upper'];
                $txK2F->tx_k2f_rr_center = $row['tx_k2f_rr_center'];
                $txK2F->tx_k2f_center = $row['tx_k2f_center'];
                $txK2F->tx_k2f_inner_upper = $row['tx_k2f_inner_upper'];
                $txK2F->tx_k2f_inner = $row['tx_k2f_inner'];
                $txK2F->tx_k2f_supply_tanggal = $row['tx_k2f_supply_tanggal'];
                $txK2F->tx_k2f_perbaikan_tanggal = $row['tx_k2f_perbaikan_tanggal'];
                $txK2F->tx_k2f_selesai_tanggal = $row['tx_k2f_selesai_tanggal'];
                $txK2F->tx_k2f_pic = $row['tx_k2f_pic'];
                $txK2F->tx_k2f_datang_tanggal = $row['tx_k2f_datang_tanggal'];
                $txK2F->tx_k2f_keterangan = $row['tx_k2f_keterangan'];
                $txK2F->updated_at = $row['updated_at'];
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
        $statement = $this->connection->prepare("DELETE FROM tx_k2f WHERE tx_k2f_id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM tx_k2f");
    }
}