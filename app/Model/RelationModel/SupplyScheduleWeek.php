<?php

namespace Subjig\Report\Model\RelationModel;

class SupplyScheduleWeek
{
    private string $schedule_id;
    private string $supply_id;
    private string $date;
    private ?string $is_implemented = null;

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
    public function getScheduleId(): string
    {
        return $this->schedule_id;
    }

    /**
     * @param string $schedule_id
     */
    public function setScheduleId(string $schedule_id): void
    {
        $this->schedule_id = $schedule_id;
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
     * @return string|null
     */
    public function getIsImplemented(): ?string
    {
        return $this->is_implemented;
    }

    /**
     * @param string|null $is_implemented
     */
    public function setIsImplemented(?string $is_implemented): void
    {
        $this->is_implemented = $is_implemented;
    }


}