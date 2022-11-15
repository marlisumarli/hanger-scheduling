<?php

namespace Subjig\Report\Entity;

class JoinK2F
{
    public string $supply_date;
    public string $id;
    public string $k2f_name;
    public string $k2f_qty;
    public string $k2f_target;
    public ?string $jumlah_id = null;
    public ?string $jumlah_line_a = null;
    public ?string $jumlah_line_b = null;
    public ?string $jumlah_line_c = null;
    public string $total;

    /**
     * @return string
     */
    public function getSupplyDate(): string
    {
        return $this->supply_date;
    }

    /**
     * @param string $supply_date
     */
    public function setSupplyDate(string $supply_date): void
    {
        $this->supply_date = $supply_date;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     */
    public function setId(string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getK2fName(): string
    {
        return $this->k2f_name;
    }

    /**
     * @param string $k2f_name
     */
    public function setK2fName(string $k2f_name): void
    {
        $this->k2f_name = $k2f_name;
    }

    /**
     * @return string|null
     */
    public function getJumlahLineA(): ?string
    {
        return $this->jumlah_line_a;
    }

    /**
     * @param string|null $jumlah_line_a
     */
    public function setJumlahLineA(?string $jumlah_line_a): void
    {
        $this->jumlah_line_a = $jumlah_line_a;
    }

    /**
     * @return string|null
     */
    public function getJumlahLineB(): ?string
    {
        return $this->jumlah_line_b;
    }

    /**
     * @param string|null $jumlah_line_b
     */
    public function setJumlahLineB(?string $jumlah_line_b): void
    {
        $this->jumlah_line_b = $jumlah_line_b;
    }

    /**
     * @return string|null
     */
    public function getJumlahLineC(): ?string
    {
        return $this->jumlah_line_c;
    }

    /**
     * @param string|null $jumlah_line_c
     */
    public function setJumlahLineC(?string $jumlah_line_c): void
    {
        $this->jumlah_line_c = $jumlah_line_c;
    }

    /**
     * @return string
     */
    public function getTotal(): string
    {
        return $this->total;
    }

    /**
     * @param string $total
     */
    public function setTotal(string $total): void
    {
        $this->total = $total;
    }

    /**
     * @return string
     */
    public function getK2fTarget(): string
    {
        return $this->k2f_target;
    }

    /**
     * @param string $k2f_target
     */
    public function setK2fTarget(string $k2f_target): void
    {
        $this->k2f_target = $k2f_target;
    }

    /**
     * @return string
     */
    public function getK2fQty(): string
    {
        return $this->k2f_qty;
    }

    /**
     * @param string $k2f_qty
     */
    public function setK2fQty(string $k2f_qty): void
    {
        $this->k2f_qty = $k2f_qty;
    }

    /**
     * @return string|null
     */
    public function getJumlahId(): ?string
    {
        return $this->jumlah_id;
    }

    /**
     * @param string|null $jumlah_id
     */
    public function setJumlahId(?string $jumlah_id): void
    {
        $this->jumlah_id = $jumlah_id;
    }


}