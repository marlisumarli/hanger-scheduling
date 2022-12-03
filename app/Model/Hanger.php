<?php

namespace Subjig\Report\Model;

class Hanger
{
    private string $id;
    private string $hanger_type_id;
    private int $order_number;
    private ?string $name = null;
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
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
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