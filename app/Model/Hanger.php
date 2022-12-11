<?php

namespace Subjig\Report\Model;

class Hanger extends HangerType
{
    private string $hanger_type_id;
    private int $order_number;
    private string $name;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
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


}