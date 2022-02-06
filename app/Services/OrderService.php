<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Product;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class OrderService implements IModelService
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAll(): Collection
    {
        return Order::all();
    }

    public function getById(int $id): Order
    {
        return Order::findOrFail($id);
    }

    public function create(array $data): Order
    {
        $order = null;
        DB::transaction(function () use ($data, &$order) {
            $orderData = Arr::except($data, 'items');
            $order = Order::create($orderData);
            $order = $this->sycnItems($order, $data['items']);
            $order->total = $this->calculateTotal($order);
            $order->save();
        });
        return $order->refresh()->load('items');
    }

    public function update(int $id, array $data): Order
    {
        $order = $this->getById($id);
        DB::transaction(function () use ($data, &$order) {
            $order = $this->sycnItems($order, $data['items']);
            $order->total = $this->calculateTotal($order);
            $order->save();
        });
        return $order->refresh()->load('items');
    }

    public function delete(int $id): bool
    {
        $order = $this->getById($id);
        return $order->delete();
    }

    public function sycnItems(Order $order, array $items): Order
    {
        foreach ($items as $item) {
            $itemData = Arr::except($item, 'product_id');
            $itemData['total'] = $this->productService->calculateTotal($item['product_id'], $item['quantity']);
            $order->items()->attach($item['product_id'], $itemData);
        }
        return $order;
    }

    public function calculateTotal(Order $order): float
    {
        return $order->items()->sum('total');
    }
}
