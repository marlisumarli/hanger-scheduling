<?php

namespace Subjig\Report\HTTP\Request;

class UserRequest
{
    public string $username;
    public string $fullName;
    public int $roleId;
    public string $password;
    public string $repeatPassword;
}