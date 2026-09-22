<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Repositories;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\StockMovementRepositoryInterface;

class StockMovementRepository extends Repository implements StockMovementRepositoryInterface {
    protected function table(): string {
        return 'stock_movements';
    }
}
