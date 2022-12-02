<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class UserRoleEnum extends Enum
{
   public const ADMIN = '0';
   public const APPLICANT = '1';
   public const HR = '2';

    public static function getRolesForRegister(): array
    {
        return [
            'applicant' => self::APPLICANT,
            'hr'        => self::HR,
        ];
    }
}
