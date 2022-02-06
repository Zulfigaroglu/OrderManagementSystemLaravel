<?php

namespace App\Services\Infrastructure;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface IModelService
{
    public function getAll(): Collection;
    public function getById(int $id): Model;
    public function create(array $data): Model;
    public function update(int $id, array $data): Model;
    public function delete(int $id): bool;
}
