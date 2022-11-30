<?php

namespace Subjig\Report\Model\RelationModel;

class SupplyScheduleHangerTypeScheduleWeek
{
    private string $hanger_type_id;
    private string $supply_id;
    private string $schedule_week_id;
    private string $date;
    private string $created_at;
    private string $mId;
    private ?int $is_implemented = null;

    /**
     * @return string
     */
    public function getMId(): string
    {
        return $this->mId;
    }

    /**
     * @param string $mId
     */
    public function setMId(string $mId): void
    {
        $this->mId = $mId;
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
    public function getScheduleWeekId(): string
    {
        return $this->schedule_week_id;
    }

    /**
     * @param string $schedule_week_id
     */
    public function setScheduleWeekId(string $schedule_week_id): void
    {
        $this->schedule_week_id = $schedule_week_id;
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
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @param string $created_at
     */
    public function setCreatedAt(string $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int|null
     */
    public function getIsImplemented(): ?int
    {
        return $this->is_implemented;
    }

    /**
     * @param int|null $is_implemented
     */
    public function setIsImplemented(?int $is_implemented): void
    {
        $this->is_implemented = $is_implemented;
    }


}