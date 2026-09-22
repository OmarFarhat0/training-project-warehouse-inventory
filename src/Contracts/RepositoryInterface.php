<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Contracts;

interface RepositoryInterface {
    public function getAll(): array;

    public function getById(int $id): ?array;

    public function create(array $attributes): array;

    public function update(int $id, array $attributes): array;
}
