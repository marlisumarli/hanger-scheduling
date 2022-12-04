<?php

namespace Subjig\Report\Model;

class ScheduleWeek
{
    private string $id;
    private string $schedule_supply_id;
    private string $date;
    private int $is_done;
    private string $m_id;

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