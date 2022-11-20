<?php

namespace Subjig\Report\HTTP;

use Subjig\Report\Model\Line;
use Subjig\Report\Model\Subjig;
use Subjig\Report\Model\Supply;
use Subjig\Report\Model\Type;
use Subjig\Report\Model\User;
use Subjig\Report\Model\UserDetail;

class ResponseSubjigApp
{
    public Line $line;
    public Supply $supply;
    public Subjig $subjig;
    public Type $type;
    public User $user;
    public UserDetail $userDetail;
}