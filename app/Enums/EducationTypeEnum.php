<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class EducationTypeEnum extends Enum
{
//    public CONST H_SCHOOL = 0;
    public CONST EDUCATION = 1;
    public CONST COURSE = 2;

    public static function getKeyWithLang(): array
    {
        $arr = [];
        $data = self::asArray();
        foreach ($data as $key => $value) {
            $subKey = __('frontPage.'.strtolower($key));
            $arr[$subKey] = $value;
        }
        return $arr;
    }
}
