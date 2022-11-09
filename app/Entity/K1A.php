<?php

namespace Subjig\Report\Entity;

class K1A
{
    public string $k1a_id;
    public string $k1a_name;
    public int $k1a_qty;
    public string $created_at;
    public ?string $updated_at = null;

    /**
     * @return string
     */
    public function getK1aId(): string
    {
        return $this->k1a_id;
    }

    /**
     * @param string $k1a_id
     */
    public function setK1aId(string $k1a_id): void
    {
        $this->k1a_id = $k1a_id;
    }

    /**
     * @return string
     */
    public function getK1aName(): string
    {
        return $this->k1a_name;
    }

    /**
     * @param string $k1a_name
     */
    public function setK1aName(string $k1a_name): void
    {
        $this->k1a_name = $k1a_name;
    }

    /**
     * @return int
     */
    public function getK1aQty(): int
    {
        return $this->k1a_qty;
    }

    /**
     * @param int $k1a_qty
     */
    public function setK1aQty(int $k1a_qty): void
    {
        $this->k1a_qty = $k1a_qty;
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

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }

    /**
     * @param string|null $updated_at
     */
    public function setUpdatedAt(?string $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}