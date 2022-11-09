<?php

namespace Subjig\Report\Entity;

class Category
{
    public string $kode;
    public string $name;
    public string $createdAt;
    public ?string $updatedAt = null;

    /**
     * @return string
     */
    public function getKode(): string
    {
        return $this->kode;
    }

    /**
     * @param string $kode
     */
    public function setKode(string $kode): void
    {
        $this->kode = $kode;
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
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @param string|null $updatedAt
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}