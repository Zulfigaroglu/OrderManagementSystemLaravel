<?php

namespace App\Enums;

class DiscountConditionType
{
    const HIGHIER_THAN_VALUE = 'higher_than_value';
    const EACH_TIMES_OF_VALUE = 'each_times_of_value';

    public static function toCommaSeperatedString()
    {
        return implode(',', [
            self::HIGHIER_THAN_VALUE,
            self::EACH_TIMES_OF_VALUE,
        ]);
    }
}
