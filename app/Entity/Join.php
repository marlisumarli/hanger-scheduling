<?php

namespace Subjig\Report\Entity;

class Join
{
    public ?string $username = null;
    public ?string $fullName = null;
    public ?string $nameRole = null;
    public ?string $createdAt = null;
    public ?string $lastLogin = null;
    public ?string $UsrDetailUpdatedAt = null;
    public ?string $usrUpdatePasswordAt = null;
    public ?string $password = null;

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    /**
     * @param string|null $fullName
     */
    public function setFullName(?string $fullName): void
    {
        $this->fullName = $fullName;
    }

    /**
     * @return string|null
     */
    public function getNameRole(): ?string
    {
        return $this->nameRole;
    }

    /**
     * @param string|null $nameRole
     */
    public function setNameRole(?string $nameRole): void
    {
        $this->nameRole = $nameRole;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @param string|null $createdAt
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
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

    /**
     * @return string|null
     */
    public function getUsrDetailUpdatedAt(): ?string
    {
        return $this->UsrDetailUpdatedAt;
    }

    /**
     * @param string|null $UsrDetailUpdatedAt
     */
    public function setUsrDetailUpdatedAt(?string $UsrDetailUpdatedAt): void
    {
        $this->UsrDetailUpdatedAt = $UsrDetailUpdatedAt;
    }

    /**
     * @return string|null
     */
    public function getUsrUpdatePasswordAt(): ?string
    {
        return $this->usrUpdatePasswordAt;
    }

    /**
     * @param string|null $usrUpdatePasswordAt
     */
    public function setUsrUpdatePasswordAt(?string $usrUpdatePasswordAt): void
    {
        $this->usrUpdatePasswordAt = $usrUpdatePasswordAt;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }


}