<?php

namespace Subjig\Report\HTTP\Request;

class ScheduleRequest
{
    public string $supplyScheduleId;
    public string $hangerTypeId;
    public string $scheduleDate;
    public int $isDone;
    public string $mId;
}
