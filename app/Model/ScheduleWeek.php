<?php

namespace Subjig\Report\Model;

class ScheduleWeek extends SupplySchedule
{
    private string $schedule_supply_id;
    private string $date;
    private string $m_id;

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