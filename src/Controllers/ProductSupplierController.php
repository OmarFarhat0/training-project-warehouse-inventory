<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Controllers;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateProductSupplierRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\Request;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\ProductSupplierService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Traits\RespondsWithJson;

class ProductSupplierController {
    use RespondsWithJson;

    public function __construct(private ProductSupplierService $productSupplierService) {}

    public function index(Request $request): void {
        $productSuppliers = $this->productSupplierService->getAll();

        $this->json('Product suppliers retrieved successfully', 200, $productSuppliers);
    }

    public function create(CreateProductSupplierRequest $request): void {
        $productSupplier = $this->productSupplierService->create($request->body());

        $this->json('Product supplier created successfully', 201, $productSupplier);
    }
}
