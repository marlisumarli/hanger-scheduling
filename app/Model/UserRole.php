<?php

namespace Subjig\Report\Model;

class UserRole
{
    private int $id;
    private string $user_role_name;
    private string $created_at;
    private ?string $updated_at = null;

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