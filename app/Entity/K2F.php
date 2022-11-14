<?php

namespace Subjig\Report\Entity;

class K2F
{
    public int $id;
    public string $k2f_id;
    public string $k2f_name;
    public int $k2f_qty;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getK2fId(): string
    {
        return $this->k2f_id;
    }

    /**
     * @param string $k2f_id
     */
    public function setK2fId(string $k2f_id): void
    {
        $this->k2f_id = $k2f_id;
    }

    /**
     * @return string
     */
    public function getK2fName(): string
    {
        return $this->k2f_name;
    }

    /**
     * @param string $k2f_name
     */
    public function setK2fName(string $k2f_name): void
    {
        $this->k2f_name = $k2f_name;
    }

    /**
     * @return int
     */
    public function getK2fQty(): int
    {
        return $this->k2f_qty;
    }

    /**
     * @param int $k2f_qty
     */
    public function setK2fQty(int $k2f_qty): void
    {
        $this->k2f_qty = $k2f_qty;
    }

}