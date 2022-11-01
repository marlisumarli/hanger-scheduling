<?php

namespace Subjig\Report\Domain;

class Karyawan
{
    public string $username;
    public string $password;
    public string $createdAt;
    public ?string $updatePasswordAt = null;
    public ?string $onlineStatus = null;
    public ?string $lastLogin = null;


}