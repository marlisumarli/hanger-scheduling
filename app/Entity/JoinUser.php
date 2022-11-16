<?php

namespace Subjig\Report\Entity;

class JoinUser
{
    private string $username;
    private string $full_name;
    private string $role_name;
    private string $created_at;
    private ?string $user_detail_updated_at = null;
    private ?string $user_update_password_at = null;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @param string $full_name
     */
    public function setFullName(string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->role_name;
    }

    /**
     * @param string $role_name
     */
    public function setRoleName(string $role_name): void
    {
        $this->role_name = $role_name;
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
    public function getUserDetailUpdatedAt(): ?string
    {
        return $this->user_detail_updated_at;
    }

    /**
     * @param string|null $user_detail_updated_at
     */
    public function setUserDetailUpdatedAt(?string $user_detail_updated_at): void
    {
        $this->user_detail_updated_at = $user_detail_updated_at;
    }

    /**
     * @return string|null
     */
    public function getUserUpdatePasswordAt(): ?string
    {
        return $this->user_update_password_at;
    }

    /**
     * @param string|null $user_update_password_at
     */
    public function setUserUpdatePasswordAt(?string $user_update_password_at): void
    {
        $this->user_update_password_at = $user_update_password_at;
    }
}