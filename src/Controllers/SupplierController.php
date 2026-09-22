<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Controllers;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateSupplierRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\Request;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\SupplierService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Traits\RespondsWithJson;

class SupplierController {
    use RespondsWithJson;

    public function __construct(private SupplierService $supplierService) {}

    public function index(Request $request): void {
        $suppliers = $this->supplierService->getAll();

        $this->json('Suppliers retrieved successfully', 200, $suppliers);
    }

    public function create(CreateSupplierRequest $request): void {
        $supplier = $this->supplierService->create($request->body());

        $this->json('Supplier created successfully', 201, $supplier);
    }
}
