<?php

namespace Subjig\Report\Entity;

class Supply
{
    protected string $supply_id;
    protected string $supply_date;

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
}