<?php

namespace Subjig\Report\Model;

class UserUpdateRequest extends UserFactory
{
    public string $username;
    public string $password;
    public string $repeatPassword;
}
