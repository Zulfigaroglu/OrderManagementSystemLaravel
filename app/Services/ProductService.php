<?php

namespace App\Services;

use App\Models\Product;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Collection;

class ProductService implements IModelService
{
    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getById(int $id): Product
    {
        return Product::findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): Product
    {
        $product = $this->getById($id);
        $product->update($data);
        return $product->refresh();
    }

    public function delete(int $id): bool
    {
        $product = $this->getById($id);
        return $product->delete();
    }

    public function calculateTotal(int $id, int $quantity)
    {
        $product = $this->getById($id);
        $total = $product->price * $quantity;
        return $total;
    }
}
