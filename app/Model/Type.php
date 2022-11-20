<?php

namespace Subjig\Report\Model;

class Type
{
    private string $type_id;
    private ?string $new_type_id = null;
    private int $type_qty;
    private string $created_at;
    private ?string $updated_at = null;

    /**
     * @return string
     */
    public function getTypeId(): string
    {
        return $this->type_id;
    }

    /**
     * @param string $type_id
     */
    public function setTypeId(string $type_id): void
    {
        $this->type_id = $type_id;
    }

    /**
     * @return int
     */
    public function getTypeQty(): int
    {
        return $this->type_qty;
    }

    /**
     * @param int $type_qty
     */
    public function setTypeQty(int $type_qty): void
    {
        $this->type_qty = $type_qty;
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

    /**
     * @return string|null
     */
    public function getNewTypeId(): ?string
    {
        return $this->new_type_id;
    }

    /**
     * @param string|null $new_type_id
     */
    public function setNewTypeId(?string $new_type_id): void
    {
        $this->new_type_id = $new_type_id;
    }

}