<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Database\QueryBuilder;
use PDO;

abstract class Repository {
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

    public function update(int $id, array $attributes): array {
        return $this->queryBuilder()->where('id', '=', $id)->update(
            id: $id,
            attributes: $attributes
        );
    }
}
