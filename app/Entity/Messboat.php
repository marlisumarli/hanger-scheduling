<?php

namespace Subjig\Report\Entity;

class Messboat
{
    public string $messboat_id;
    public string $messboat_name;
    public int $messboat_qty;
    public string $created_at;
    public ?string $updated_at = null;
}