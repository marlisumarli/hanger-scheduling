<?php

namespace Subjig\Report\Model;

class SupplySchedule
{
    private string $id;
    private string $hanger_type_id;
    private string $month;
    private string $period_id;
    private int $is_done;

    /**
     * @return int
     */
    public function getIsDone(): int
    {
        return $this->is_done;
    }

    /**
     * @param int $is_done
     */
    public function setIsDone(int $is_done): void
    {
        $this->is_done = $is_done;
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
    public function getMonth(): string
    {
        return $this->month;
    }

    /**
     * @param string $month
     */
    public function setMonth(string $month): void
    {
        $this->month = $month;
    }

    /**
     * @return string
     */
    public function getPeriodId(): string
    {
        return $this->period_id;
    }

    /**
     * @param string $period_id
     */
    public function setPeriodId(string $period_id): void
    {
        $this->period_id = $period_id;
    }

}