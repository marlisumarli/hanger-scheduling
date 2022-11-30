<?php

namespace Subjig\Report\Model;

class Supply
{
    private string $id;
    private string $hanger_Type_id;
    private string $schedule_week_id;
    private int $target_set = 0;

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
        return $this->hanger_Type_id;
    }

    /**
     * @param string $hanger_Type_id
     */
    public function setHangerTypeId(string $hanger_Type_id): void
    {
        $this->hanger_Type_id = $hanger_Type_id;
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
     * @return int
     */
    public function getTargetSet(): int
    {
        return $this->target_set;
    }

    /**
     * @param int $target_set
     */
    public function setTargetSet(int $target_set): void
    {
        $this->target_set = $target_set;
    }


}