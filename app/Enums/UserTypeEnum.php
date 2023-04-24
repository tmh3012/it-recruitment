<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserTypeEnum extends Enum
{
    const DEFAULT_USER = 0;
    const OAUTH_USER = 1;
}
