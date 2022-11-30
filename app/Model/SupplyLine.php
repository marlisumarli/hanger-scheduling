<?php

namespace Subjig\Report\Model;

class SupplyLine
{
    private int $id;
    private string $supply_id;
    private string $hanger_id;
    private int $line_a;
    private int $line_b;
    private int $line_c;
    private int $total;

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
    public function getHangerId(): string
    {
        return $this->hanger_id;
    }

    /**
     * @param string $hanger_id
     */
    public function setHangerId(string $hanger_id): void
    {
        $this->hanger_id = $hanger_id;
    }

    /**
     * @return int
     */
    public function getLineA(): int
    {
        return $this->line_a;
    }

    /**
     * @param int $line_a
     */
    public function setLineA(int $line_a): void
    {
        $this->line_a = $line_a;
    }

    /**
     * @return int
     */
    public function getLineB(): int
    {
        return $this->line_b;
    }

    /**
     * @param int $line_b
     */
    public function setLineB(int $line_b): void
    {
        $this->line_b = $line_b;
    }

    /**
     * @return int
     */
    public function getLineC(): int
    {
        return $this->line_c;
    }

    /**
     * @param int $line_c
     */
    public function setLineC(int $line_c): void
    {
        $this->line_c = $line_c;
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