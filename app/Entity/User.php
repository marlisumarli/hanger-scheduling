<?php

namespace Subjig\Report\Entity;

class User
{
    public string $username;
    public string $password;
    public string $createdAt;
    public ?string $updatePasswordAt = null;
    public ?string $onlineStatus = null;
    public ?string $lastLogin = null;
    public ?string $token = null;

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
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
    public function getUpdatePasswordAt(): ?string
    {
        return $this->updatePasswordAt;
    }

    /**
     * @param string|null $updatePasswordAt
     */
    public function setUpdatePasswordAt(?string $updatePasswordAt): void
    {
        $this->updatePasswordAt = $updatePasswordAt;
    }

    /**
     * @return string|null
     */
    public function getOnlineStatus(): ?string
    {
        return $this->onlineStatus;
    }

    /**
     * @param string|null $onlineStatus
     */
    public function setOnlineStatus(?string $onlineStatus): void
    {
        $this->onlineStatus = $onlineStatus;
    }

    /**
     * @return string|null
     */
    public function getLastLogin(): ?string
    {
        return $this->lastLogin;
    }

    /**
     * @param string|null $lastLogin
     */
    public function setLastLogin(?string $lastLogin): void
    {
        $this->lastLogin = $lastLogin;
    }
}