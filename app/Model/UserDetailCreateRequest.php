<?php

namespace Subjig\Report\Model;

class UserDetailCreateRequest extends UserDetailUpdateRequest
{
    public string $username;
    public string $fullName;
    public int $roleId;
}