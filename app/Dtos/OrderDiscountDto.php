<?php

namespace App\Dtos;

class OrderDiscountDto
{
    public int $order_id;
    public float $total_discount;
    public float $discounted_total;

    /**
     * @var DiscountDetailDto[]
     */
    public array $discounts;
}
