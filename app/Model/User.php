<?php

namespace Subjig\Report\Model;

class User
{
    private string $username;
    private string $password;
    private string $created_at;
    private ?string $update_password_at = null;

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
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
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
    public function getUpdatePasswordAt(): ?string
    {
        return $this->update_password_at;
    }

    /**
     * @param string|null $update_password_at
     */
    public function setUpdatePasswordAt(?string $update_password_at): void
    {
        $this->update_password_at = $update_password_at;
    }

}