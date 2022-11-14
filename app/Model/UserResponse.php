<?php

namespace Subjig\Report\Model;

use Subjig\Report\Entity\User;
use Subjig\Report\Entity\UserDetail;

class UserResponse
{
    public User $user;
    public UserDetail $userDetail;
}