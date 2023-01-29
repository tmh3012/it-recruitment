<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class BlogStatusEnum extends Enum
{
    const PENDING = 0;
    const APPROVED = 1;
    const DRAFT =   2;
}
