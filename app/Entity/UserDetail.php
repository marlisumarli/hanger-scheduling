<?php

namespace Subjig\Report\Entity;

class UserDetail
{
    public string $id;
    public string $credential;
    public string $fullName;
    public int $roleId;
    public ?string $updatedAt = null;
}