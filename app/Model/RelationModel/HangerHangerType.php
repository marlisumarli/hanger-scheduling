<?php

namespace Subjig\Report\Model\RelationModel;

class HangerHangerType
{
    private int $order_number;
    private string $hanger_name;
    private int $hanger_type_qty;
    private string $hanger_id;
    private string $hanger_type_id;
    private int $hanger_qty;
    private string $created_at;
    private ?string $updated_at = null;

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
    public function getHangerName(): string
    {
        return $this->hanger_name;
    }

    /**
     * @param string $hanger_name
     */
    public function setHangerName(string $hanger_name): void
    {
        $this->hanger_name = $hanger_name;
    }

    /**
     * @return int
     */
    public function getHangerTypeQty(): int
    {
        return $this->hanger_type_qty;
    }

    /**
     * @param int $hanger_type_qty
     */
    public function setHangerTypeQty(int $hanger_type_qty): void
    {
        $this->hanger_type_qty = $hanger_type_qty;
    }

    /**
     * @return string
     */
    public function getHangerId(): string
    {
        return $this->hanger_id;
    }

    /**
     * @param string $hanger_id
     */
    public function setHangerId(string $hanger_id): void
    {
        $this->hanger_id = $hanger_id;
    }

    /**
     * @return string
     */
    public function getHangerTypeId(): string
    {
        return $this->hanger_type_id;
    }

    /**
     * @param string $hanger_type_id
     */
    public function setHangerTypeId(string $hanger_type_id): void
    {
        $this->hanger_type_id = $hanger_type_id;
    }

    /**
     * @return int
     */
    public function getHangerQty(): int
    {
        return $this->hanger_qty;
    }

    /**
     * @param int $hanger_qty
     */
    public function setHangerQty(int $hanger_qty): void
    {
        $this->hanger_qty = $hanger_qty;
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