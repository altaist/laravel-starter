<?php

namespace App\Services\Tasks;

use App\Models\Tasks\Action;
use App\Models\Tasks\Moderation;
use App\Models\User;
use App\Services\BaseService;

class ModerationStatus
{
    public static $NEW = 0;
    public static $WATING_MODERATOR = 1;
    public static $MODERATING = 2;
    public static $DECLINED = 3;
    public static $DISAPROVED = 4;
    public static $APROVED = 5;
}
