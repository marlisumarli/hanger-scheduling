<?php

namespace Subjig\Report\HTTP\Request;

class UserRequest
{
    public ?string $username = null;
    public ?string $fullName = null;
    public ?string $password = null;
    public ?int $role = null;
}