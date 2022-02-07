<?php

namespace App\Services;

use App\Dtos\DiscountDetailDto;
use App\Dtos\OrderDiscountDto;
use App\Models\Discount;
use App\Models\Order;
use App\Services\Helpers\DiscountHelper;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Collection;

class DiscountService implements IModelService
{
    protected OrderService $orderService;
    protected DiscountHelper $discountHelper;

    public function __construct(OrderService $orderService, DiscountHelper $discountHelper)
    {
        $this->orderService = $orderService;
        $this->discountHelper = $discountHelper;
    }

    public function getAll(): Collection
    {
        return Discount::all();
    }

    public function getById(int $id): Discount
    {
        return Discount::findOrFail($id);
    }

    public function create(array $data): Discount
    {
        return Discount::create($data);
    }

    public function update(int $id, array $data): Discount
    {
        $discount = $this->getById($id);
        $discount->update($data);
        return $discount->refresh();
    }

    public function delete(int $id): bool
    {
        $discount = $this->getById($id);
        return $discount->delete();
    }

    public function apply(int $orderId)
    {
        $orderDiscountDto = new OrderDiscountDto();
        $orderDiscountDto->order_id = $orderId;

        $order = $this->orderService->getById($orderId);
        $discounts = $this->getAll();
        foreach ($discounts as $discount) {
            $discountDetails = $this->discountHelper->applyDiscountToOrder($discount, $order);
            if(!!$discountDetails){
                $orderDiscountDto->discounts[] = $discountDetails;
            }
        }

        return $orderDiscountDto;
    }
}
