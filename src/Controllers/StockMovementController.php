<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Controllers;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateStockMovementRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\Request;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\StockMovementService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Traits\RespondsWithJson;

class StockMovementController {
    use RespondsWithJson;

    public function __construct(private StockMovementService $stockMovementService) {}

    public function index(Request $request): void {
        $movements = $this->stockMovementService->getAll();

        $this->json('Stock movements retrieved successfully', 200, $movements);
    }

    public function create(CreateStockMovementRequest $request): void {
        $movement = $this->stockMovementService->create($request->body());

        $this->json('Stock movement created successfully', 201, $movement);
    }
}
