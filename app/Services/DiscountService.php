<?php

namespace App\Services;

use App\Models\Discount;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Collection;

class DiscountService implements IModelService
{
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
}
