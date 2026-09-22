<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Controllers;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateProductRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\Request;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\ProductService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Traits\RespondsWithJson;

class ProductController {
    use RespondsWithJson;

    public function __construct(private ProductService $productService) {}

    public function index(Request $request): void {
        $products = $this->productService->getAll();

        $this->json('Products retrieved successfully', 200, $products);
    }

    public function create(CreateProductRequest $request): void {
        $product = $this->productService->create($request->body());

        $this->json('Product created successfully', 201, $product);
    }
}
