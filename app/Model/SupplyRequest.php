<?php

namespace Subjig\Report\Model;

class SupplyRequest
{
    public string $type;
    public string $lineId;
    public string $orderId;
    public string $supplyId;
    public string $supplyTarget;
    public string $supplyDate;
    public string $subjigId;
    public int $jumlahLineA;
    public int $jumlahLineB;
    public int $jumlahLineC;
}