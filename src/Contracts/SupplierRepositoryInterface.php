<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Contracts;

interface SupplierRepositoryInterface extends RepositoryInterface {
    public function existsByPhone(string $phone): bool;
}
