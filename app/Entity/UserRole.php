<?php

namespace Subjig\Report\Entity;

class UserRole
{
    protected int $user_role_id;
    protected string $user_role_name;
    protected string $created_at;
    protected ?string $updated_at = null;

    /**
     * @return int
     */
    public function getUserRoleId(): int
    {
        return $this->user_role_id;
    }

    /**
     * @param int $user_role_id
     */
    public function setUserRoleId(int $user_role_id): void
    {
        $this->user_role_id = $user_role_id;
    }

    /**
     * @return string
     */
    public function getUserRoleName(): string
    {
        return $this->user_role_name;
    }

    /**
     * @param string $user_role_name
     */
    public function setUserRoleName(string $user_role_name): void
    {
        $this->user_role_name = $user_role_name;
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