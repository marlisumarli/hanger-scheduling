<?php

namespace Subjig\Report\Model;

class HangerType extends Model
{
    private ?string $new_id = null;
    protected int $qty;

    /**
     * @return string|null
     */
    public function getNewId(): ?string
    {
        return $this->new_id;
    }

    /**
     * @param string|null $new_id
     */
    public function setNewId(?string $new_id): void
    {
        $this->new_id = $new_id;
    }

    /**
     * @return int
     */
    public function getQty(): int
    {
        return $this->qty;
    }

    /**
     * @param int $qty
     */
    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }
}