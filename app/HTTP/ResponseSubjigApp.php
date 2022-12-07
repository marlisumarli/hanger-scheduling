<?php

namespace Subjig\Report\HTTP;

use Subjig\Report\Model\Hanger;
use Subjig\Report\Model\HangerType;
use Subjig\Report\Model\ScheduleWeek;
use Subjig\Report\Model\Supply;
use Subjig\Report\Model\SupplyLine;
use Subjig\Report\Model\SupplySchedule;
use Subjig\Report\Model\User;

class ResponseSubjigApp
{
    public SupplyLine $supplyLine;
    public Supply $supply;
    public Hanger $hanger;
    public HangerType $hangerType;
    public User $user;
    public ScheduleWeek $scheduleWeek;
    public SupplySchedule $supplySchedule;
}