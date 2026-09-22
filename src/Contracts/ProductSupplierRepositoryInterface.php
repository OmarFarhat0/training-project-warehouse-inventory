<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Contracts;

interface ProductSupplierRepositoryInterface extends RepositoryInterface {
    public function existsByProductAndSupplier(int $productId, int $supplierId): bool;
}
