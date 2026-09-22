<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductRepositoryInterface;

class ProductRepository extends Repository implements ProductRepositoryInterface {
    protected function table(): string {
        return 'products';
    }

    public function existsBySku(string $sku): bool {
        return $this->queryBuilder()->where('sku', '=', $sku)->exists();
    }
}
