<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductSupplierRepositoryInterface;

class ProductSupplierRepository extends Repository implements ProductSupplierRepositoryInterface {
    protected function table(): string {
        return 'product_suppliers';
    }

    public function existsByProductAndSupplier(int $productId, int $supplierId): bool {
        return $this->queryBuilder()
            ->where('product_id', '=', $productId)
            ->where('supplier_id', '=', $supplierId)
            ->exists();
    }
}
