<?php

namespace Subjig\Report\Entity;

class Messboat
{
    public string $kode;
    public string $name;
    public int $qty;
    public string $createdAt;
    public ?string $updatedAt = null;
}