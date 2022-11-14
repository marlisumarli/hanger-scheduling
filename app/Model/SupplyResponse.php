<?php

namespace Subjig\Report\Model;

use Subjig\Report\Entity\Line;
use Subjig\Report\Entity\Supply;

class SupplyResponse
{
    public Supply $supply;
    public Line $line;
}