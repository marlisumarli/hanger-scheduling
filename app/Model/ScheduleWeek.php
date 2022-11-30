<?php

namespace Subjig\Report\Model;

class ScheduleWeek
{
    private int $id;
    private string $schedule_supply_id;
    private string $date;
    private int $is_implemented;
    private string $m_id;

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
    public function getScheduleSupplyId(): string
    {
        return $this->schedule_supply_id;
    }

    /**
     * @param string $schedule_supply_id
     */
    public function setScheduleSupplyId(string $schedule_supply_id): void
    {
        $this->schedule_supply_id = $schedule_supply_id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @param string $date
     */
    public function setDate(string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return int
     */
    public function getIsImplemented(): int
    {
        return $this->is_implemented;
    }

    /**
     * @param int $is_implemented
     */
    public function setIsImplemented(int $is_implemented): void
    {
        $this->is_implemented = $is_implemented;
    }

    /**
     * @return string
     */
    public function getMId(): string
    {
        return $this->m_id;
    }

    /**
     * @param string $m_id
     */
    public function setMId(string $m_id): void
    {
        $this->m_id = $m_id;
    }

}