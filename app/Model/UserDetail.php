<?php

namespace Subjig\Report\Model;

class UserDetail
{
    private string $user_detail_id;
    private string $username;
    private string $full_name;
    private int $role_id;
    private ?string $updated_at = null;

    /**
     * @return string
     */
    public function getUserDetailId(): string
    {
        return $this->user_detail_id;
    }

    /**
     * @param string $user_detail_id
     */
    public function setUserDetailId(string $user_detail_id): void
    {
        $this->user_detail_id = $user_detail_id;
    }

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
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @param int $role_id
     */
    public function setRoleId(int $role_id): void
    {
        $this->role_id = $role_id;
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