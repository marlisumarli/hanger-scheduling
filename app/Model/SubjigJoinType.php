<?php

namespace Subjig\Report\Model;

class SubjigJoinType
{
    private int $order_number;
    private string $subjig_name;
    private int $type_qty;
    private string $subjig_id;
    private string $type_id;
    private int $subjig_qty;
    private string $created_at;
    private ?string $updated_at = null;

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
     * @return int
     */
    public function getOrderNumber(): int
    {
        return $this->order_number;
    }

    /**
     * @param int $order_number
     */
    public function setOrderNumber(int $order_number): void
    {
        $this->order_number = $order_number;
    }

    /**
     * @return string
     */
    public function getSubjigId(): string
    {
        return $this->subjig_id;
    }

    /**
     * @param string $subjig_id
     */
    public function setSubjigId(string $subjig_id): void
    {
        $this->subjig_id = $subjig_id;
    }

    /**
     * @return string
     */
    public function getSubjigName(): string
    {
        return $this->subjig_name;
    }

    /**
     * @param string $subjig_name
     */
    public function setSubjigName(string $subjig_name): void
    {
        $this->subjig_name = $subjig_name;
    }

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
    public function getSubjigQty(): int
    {
        return $this->subjig_qty;
    }

    /**
     * @param int $subjig_qty
     */
    public function setSubjigQty(int $subjig_qty): void
    {
        $this->subjig_qty = $subjig_qty;
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