<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Contracts;

interface ProductRepositoryInterface extends RepositoryInterface {
    public function existsBySku(string $sku): bool;
}
