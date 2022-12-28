<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class PostRemoteEnum extends Enum
{
    public const ALL = 0;
    public const ON_SITE = 1;
    public const HYPER = 2;
    public const REMOTE = 3;

    static function getArrayWithLowerKey(): array
    {
        $arr = [];
        $data = self::asArray();
        foreach ($data as $key => $value) {
            $index = strtolower($key);
            $arr[$index] = $value;
        }
        return $arr;
    }
    static function getArrayWithoutKeys():array
    {
        $array = self::asArray();
        array_shift($array);
        return $array;
    }
}
