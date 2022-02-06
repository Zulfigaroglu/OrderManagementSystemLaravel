<?php

namespace App\Enums;

class DiscountConditionSubject
{
    const TOTAL_PRICE = 'total_price';
    const PRODUCT_QUANTITY = 'product_quantity';
    const ITEM_COUNT = 'item_count';

    public static function toCommaSeperatedString()
    {
        return implode(',', [
            self::TOTAL_PRICE,
            self::PRODUCT_QUANTITY,
            self::ITEM_COUNT,
        ]);
    }
}
