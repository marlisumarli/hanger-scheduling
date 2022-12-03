<?php

namespace Subjig\Report\Model;

class HangerType
{
    private string $id;
    private ?string $new_id = null;
    private int $qty;
    private string $created_at;

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

}