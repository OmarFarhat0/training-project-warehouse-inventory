<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\SupplierRepositoryInterface;

class SupplierRepository extends Repository implements SupplierRepositoryInterface {
    protected function table(): string {
        return 'suppliers';
    }

    public function existsByPhone(string $phone): bool {
        return $this->queryBuilder()->where('phone', '=', $phone)->exists();
    }
}
