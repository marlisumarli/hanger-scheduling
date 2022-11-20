<?php

namespace Subjig\Report\Model;

class SubjigJoinSupply
{
    private string $supply_date;
    private string $order_id;
    private string $subjig_name;
    private string $type_id;
    private string $subjig_qty;
    private string $line_target;
    private string $supply_line_id;
    private ?string $jumlah_line_a = null;
    private ?string $jumlah_line_b = null;
    private ?string $jumlah_line_c = null;
    private string $supply_target;
    private string $total;

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
    public function getOrderId(): string
    {
        return $this->order_id;
    }

    /**
     * @param string $order_id
     */
    public function setOrderId(string $order_id): void
    {
        $this->order_id = $order_id;
    }

    /**
     * @return string
     */
    public function getSubjigName(): string
    {
        return $this->subjig_name;
    }

    /**
     * @param string $subjig_name
     */
    public function setSubjigName(string $subjig_name): void
    {
        $this->subjig_name = $subjig_name;
    }

    /**
     * @return string
     */
    public function getTypeId(): string
    {
        return $this->type_id;
    }

    /**
     * @param string $type_id
     */
    public function setTypeId(string $type_id): void
    {
        $this->type_id = $type_id;
    }

    /**
     * @return string
     */
    public function getSubjigQty(): string
    {
        return $this->subjig_qty;
    }

    /**
     * @param string $subjig_qty
     */
    public function setSubjigQty(string $subjig_qty): void
    {
        $this->subjig_qty = $subjig_qty;
    }

    /**
     * @return string
     */
    public function getLineTarget(): string
    {
        return $this->line_target;
    }

    /**
     * @param string $line_target
     */
    public function setLineTarget(string $line_target): void
    {
        $this->line_target = $line_target;
    }

    /**
     * @return string
     */
    public function getSupplyLineId(): string
    {
        return $this->supply_line_id;
    }

    /**
     * @param string $supply_line_id
     */
    public function setSupplyLineId(string $supply_line_id): void
    {
        $this->supply_line_id = $supply_line_id;
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
    public function getSupplyTarget(): string
    {
        return $this->supply_target;
    }

    /**
     * @param string $supply_target
     */
    public function setSupplyTarget(string $supply_target): void
    {
        $this->supply_target = $supply_target;
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

}