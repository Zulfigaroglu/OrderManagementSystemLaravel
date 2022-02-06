<?php

namespace App\Enums;

class DiscountPolicySubject
{
    const ORDER = 'order';
    const ANY_ITEM = 'any_item';
    const CHEAPEST_ITEM = 'cheapest_item';

    public static function toCommaSeperatedString()
    {
        return implode(',', [
            self::ORDER,
            self::ANY_ITEM,
            self::CHEAPEST_ITEM,
        ]);
    }
}
