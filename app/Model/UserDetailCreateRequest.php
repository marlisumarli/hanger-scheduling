<?php

namespace Subjig\Report\Model;

class UserDetailCreateRequest extends UserDetailUpdateRequest
{
    public string $credential;
    public string $fullName;
    public int $role;
}