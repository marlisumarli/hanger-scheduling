<?php

namespace Subjig\Report\HTTP\Request;

class SupplyRequest
{
    public string $supplyId;
    public string $hangerId;
    public string $scheduleSupplyId;
    public string $hangerTypeId;
    public string $supplyLineId;
    public string $supplyTarget;
    public int $lineA;
    public int $lineB;
    public int $lineC;
}