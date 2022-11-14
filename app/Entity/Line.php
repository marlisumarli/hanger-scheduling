<?php

namespace Subjig\Report\Entity;

class Line
{
    public int $id;
    public string $supply_id;
    public string $subjig_id;
    public int $jumlah_line_a;
    public int $jumlah_line_b;
    public int $jumlah_line_c;
    public int $total;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getSupplyId(): string
    {
        return $this->supply_id;
    }

    /**
     * @param string $supply_id
     */
    public function setSupplyId(string $supply_id): void
    {
        $this->supply_id = $supply_id;
    }

    /**
     * @return string
     */
    public function getSubjigId(): string
    {
        return $this->subjig_id;
    }

    /**
     * @param string $subjig_id
     */
    public function setSubjigId(string $subjig_id): void
    {
        $this->subjig_id = $subjig_id;
    }

    /**
     * @return int
     */
    public function getJumlahLineA(): int
    {
        return $this->jumlah_line_a;
    }

    /**
     * @param int $jumlah_line_a
     */
    public function setJumlahLineA(int $jumlah_line_a): void
    {
        $this->jumlah_line_a = $jumlah_line_a;
    }

    /**
     * @return int
     */
    public function getJumlahLineB(): int
    {
        return $this->jumlah_line_b;
    }

    /**
     * @param int $jumlah_line_b
     */
    public function setJumlahLineB(int $jumlah_line_b): void
    {
        $this->jumlah_line_b = $jumlah_line_b;
    }

    /**
     * @return int
     */
    public function getJumlahLineC(): int
    {
        return $this->jumlah_line_c;
    }

    /**
     * @param int $jumlah_line_c
     */
    public function setJumlahLineC(int $jumlah_line_c): void
    {
        $this->jumlah_line_c = $jumlah_line_c;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }
}