<?php

namespace Subjig\Report\Model\RelationModel;

class HangerSupplyLineSupply
{
    private string $order_number;
    private string $hanger_name;
    private string $hanger_type_id;
    private string $hanger_qty;
    private string $supply_line_id;
    private ?string $line_a = null;
    private ?string $line_b = null;
    private ?string $line_c = null;
    private string $target_set;
    private string $total;

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->order_number;
    }

    /**
     * @param string $order_number
     */
    public function setOrderNumber(string $order_number): void
    {
        $this->order_number = $order_number;
    }

    /**
     * @return string
     */
    public function getHangerName(): string
    {
        return $this->hanger_name;
    }

    /**
     * @param string $hanger_name
     */
    public function setHangerName(string $hanger_name): void
    {
        $this->hanger_name = $hanger_name;
    }

    /**
     * @return string
     */
    public function getHangerTypeId(): string
    {
        return $this->hanger_type_id;
    }

    /**
     * @param string $hanger_type_id
     */
    public function setHangerTypeId(string $hanger_type_id): void
    {
        $this->hanger_type_id = $hanger_type_id;
    }

    /**
     * @return string
     */
    public function getHangerQty(): string
    {
        return $this->hanger_qty;
    }

    /**
     * @param string $hanger_qty
     */
    public function setHangerQty(string $hanger_qty): void
    {
        $this->hanger_qty = $hanger_qty;
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
    public function getLineA(): ?string
    {
        return $this->line_a;
    }

    /**
     * @param string|null $line_a
     */
    public function setLineA(?string $line_a): void
    {
        $this->line_a = $line_a;
    }

    /**
     * @return string|null
     */
    public function getLineB(): ?string
    {
        return $this->line_b;
    }

    /**
     * @param string|null $line_b
     */
    public function setLineB(?string $line_b): void
    {
        $this->line_b = $line_b;
    }

    /**
     * @return string|null
     */
    public function getLineC(): ?string
    {
        return $this->line_c;
    }

    /**
     * @param string|null $line_c
     */
    public function setLineC(?string $line_c): void
    {
        $this->line_c = $line_c;
    }

    /**
     * @return string
     */
    public function getTargetSet(): string
    {
        return $this->target_set;
    }

    /**
     * @param string $target_set
     */
    public function setTargetSet(string $target_set): void
    {
        $this->target_set = $target_set;
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