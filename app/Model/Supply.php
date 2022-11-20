<?php

namespace Subjig\Report\Model;

class Supply
{
    private string $supply_id;
    private string $type_id;
    private string $supply_date;
    private string $target_set;

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

}