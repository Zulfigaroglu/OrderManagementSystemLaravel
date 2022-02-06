<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Infrastructure\IModelService;
use Illuminate\Support\Collection;

class CategoryService implements IModelService
{
    public function getAll(): Collection
    {
        return Category::all();
    }

    public function getById(int $id): Category
    {
        return Category::findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): Category
    {
        $category = $this->getById($id);
        $category->update($data);
        return $category->refresh();
    }

    public function delete(int $id): bool
    {
        $category = $this->getById($id);
        return $category->delete();
    }
}
