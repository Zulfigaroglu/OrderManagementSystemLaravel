<?php

namespace App\Services;

use App\Models\Customer;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Collection;

class CustomerService implements IModelService
{
    public function getAll(): Collection
    {
        return Customer::all();
    }

    public function getById(int $id): Customer
    {
        return Customer::findOrFail($id);
    }

    public function create(array $data): Customer
    {
        return Customer::create($data);
    }

    public function update(int $id, array $data): Customer
    {
        $customer = $this->getById($id);
        $customer->update($data);
        return $customer->refresh();
    }

    public function delete(int $id): bool
    {
        $customer = $this->getById($id);
        return $customer->delete();
    }
}
