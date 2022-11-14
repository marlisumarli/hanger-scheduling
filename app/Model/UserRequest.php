<?php

namespace Subjig\Report\Model;

class UserRequest
{
    public string $username;
    public string $fullName;
    public int $roleId;
    public string $password;
    public string $repeatPassword;
}