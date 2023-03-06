<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class PostStatusEnum extends Enum
{
    public const PENDING = 0;
    public const ADMIN_PENDING = 1;
    public const ADMIN_APPROVED = 2;

    public function getStatusByRole(): int
    {
        if (isAdmin()) {
            return self::ADMIN_APPROVED;
        }
        return self::PENDING;
    }

    static function getStatusWithLang(): array
    {
        $arr = [];
        $data = self::asArray();
        foreach ($data as $key => $value) {
            $descriptionKey = __('frontPage.' .strtolower($key));
            $arr[$descriptionKey] = $value;
        }
        return $arr;
    }
}
