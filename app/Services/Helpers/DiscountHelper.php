<?php

namespace App\Services\Helpers;

use App\Dtos\DiscountDetailDto;
use App\Enums\DiscountConditionSubject;
use App\Enums\DiscountConditionType;
use App\Enums\DiscountPolicySubject;
use App\Enums\DiscountPolicyType;
use App\Models\Discount;
use App\Models\Order;
use Exception;
use Illuminate\Support\Collection;

class DiscountHelper
{
    public function applyDiscountToOrder(Discount $discount, Order $order): ?DiscountDetailDto
    {
        $items = $this->getItemsFromOrderByCategoryId($order, $discount->category_id);
        $conditionSubjectValue = $this->getConditionSubjectValue($discount, $items);
        if (!$conditionSubjectValue) {
            return null;
        }

        $timesOfConditionMet = $this->getTimesOfConditionMet($discount, $conditionSubjectValue);
        if ($timesOfConditionMet == 0) {
            return null;
        }

        $amountToBeDiscounted = $this->getAmountToBeDiscounted($discount, $items);
        $discountAmount = $this->calculateDiscountAmount($discount, $amountToBeDiscounted, $timesOfConditionMet);

        $discountDetailDto = new DiscountDetailDto();
        $discountDetailDto->discount_amount = $discountAmount;
        $discountDetailDto->discount_reason = $discount->name;
        $discountDetailDto->subtotal = $order->total - $discountAmount;
        return $discountDetailDto;
    }

    protected function getTimesOfConditionMet(Discount $discount, int $conditionSubjectValue): int
    {
        switch ($discount->condition_type) {
            case DiscountConditionType::EACH_TIMES_OF_VALUE:
            {
                return $conditionSubjectValue / $discount->condition_value;
            }
            case DiscountConditionType::HIGHIER_THAN_VALUE:
            {
                return ($conditionSubjectValue > $discount->condition_value) ? 1 : 0;
            }
        }
        throw new Exception("Discount Condition Type is not implemented!");
    }

    protected function getConditionSubjectValue(Discount $discount, Collection $items): int
    {
        switch ($discount->condition_subject) {
            case DiscountConditionSubject::TOTAL_PRICE:
            {
                return $items->sum('pivot.total');
            }
            case DiscountConditionSubject::ITEM_COUNT:
            {
                return $items->sum('pivot.quantity');
            }
            case DiscountConditionSubject::PRODUCT_QUANTITY:
            {
                return $items->max('pivot.quantity');
            }
        }
        throw new Exception("Discount Condition Subject is not implemented!");
    }

    protected function getItemsFromOrderByCategoryId(Order $order, ?int $catecoryId): Collection
    {
        /**
         * @var Collection $items
         */
        $items = $order->items;
        if(!$catecoryId){
            $items = $items->where('category_id', $catecoryId);
        }
        return $items;
    }

    protected function getAmountToBeDiscounted(Discount $discount, Collection $items): int
    {
        switch ($discount->policy_subject) {
            case DiscountPolicySubject::ANY_ITEM:
            {
                return $items->first()->price;
            }
            case DiscountPolicySubject::CHEAPEST_ITEM:
            {
                return $items->min('price');
            }
            case DiscountPolicySubject::ORDER:
            {
                return $items->sum('pivot.total');
            }
        }
        throw new Exception("Discount Policy Subject is not implemented!");
    }

    protected function calculateDiscountAmount(Discount $discount, float $amountToBeDiscounted, int $timesOfConditionMet): float
    {
        switch ($discount->policy_type) {
            case DiscountPolicyType::DISCOUNT_BY_PERCENTAGE:
            {
                return $amountToBeDiscounted * ($discount->policy_value / 100) * $timesOfConditionMet;
            }
            case DiscountPolicyType::DISCOUNT_BY_TOTAL:
            {
                return $discount->policy_value * $timesOfConditionMet;
            }
            case DiscountPolicyType::GIVE_FREE:
            {
                return $amountToBeDiscounted * $timesOfConditionMet;
            }
        }
        throw new Exception("Discount Policy Type is not implemented!");
    }
}
