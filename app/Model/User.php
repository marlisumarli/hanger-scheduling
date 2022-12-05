<?php

namespace Subjig\Report\Model;

class User
{
    private ?string $username = null;
    private ?string $password = null;
    private ?string $full_name = null;
    private ?int $role_id = null;
    private ?string $last_login = null;

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

    /**
     * @return string|null
     */
    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    /**
     * @param string|null $full_name
     */
    public function setFullName(?string $full_name): void
    {
        $this->full_name = $full_name;
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->role_id;
    }

    /**
     * @param int|null $role_id
     */
    public function setRoleId(?int $role_id): void
    {
        $this->role_id = $role_id;
    }

    /**
     * @return string|null
     */
    public function getLastLogin(): ?string
    {
        return $this->last_login;
    }

    /**
     * @param string|null $last_login
     */
    public function setLastLogin(?string $last_login): void
    {
        $this->last_login = $last_login;
    }

}