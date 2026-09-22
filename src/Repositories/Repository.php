<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\RepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Database\QueryBuilder;
use PDO;

abstract class Repository implements RepositoryInterface {
    public function __construct(private PDO $db) {}

    abstract protected function table(): string;

    protected function queryBuilder() {
        return new QueryBuilder($this->db, $this->table());
    }

    public function getAll(): array {
        return $this->queryBuilder()->get();
    }

    public function getById(int $id): ?array {
        $items = $this->queryBuilder()->where('id', '=', $id)->get();
        return $items[0] ?? null;
    }

    public function create(array $attributes): array {
        $id = $this->queryBuilder()->create($attributes);

        return $this->getById($id);
    }

    public function update(int $id, array $attributes): array {
        return $this->queryBuilder()->where('id', '=', $id)->update(
            id: $id,
            attributes: $attributes
        );
    }
}
