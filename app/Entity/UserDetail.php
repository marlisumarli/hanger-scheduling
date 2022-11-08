<?php

namespace Subjig\Report\Entity;

class UserDetail
{
    public string $id;
    public string $credential;
    public string $fullName;
    public int $roleId;
    public ?string $updatedAt = null;

    /**
     * @return string
     */
    public function getCredential(): string
    {
        return $this->credential;
    }

    /**
     * @param string $credential
     */
    public function setCredential(string $credential): void
    {
        $this->credential = $credential;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @param string $fullName
     */
    public function setFullName(string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->roleId;
    }

    /**
     * @param int $roleId
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
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