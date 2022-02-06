<?php

namespace App\Dtos;

class OrderDto
{
    public int $id;
    public int $customer_id;
    public float $total;
    public string $created_at;
    public string $updated_at;

    /**
     * @var ItemDto[]
     */
    public array $items;
}
