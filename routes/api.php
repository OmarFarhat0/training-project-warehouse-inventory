<?php

use Omarfarhat0\TrainingProjectWarehouseInventory\Controllers\ProductController;
use Omarfarhat0\TrainingProjectWarehouseInventory\Controllers\StockMovementController;
use Omarfarhat0\TrainingProjectWarehouseInventory\Controllers\SupplierController;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateProductRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateStockMovementRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests\CreateSupplierRequest;
use Omarfarhat0\TrainingProjectWarehouseInventory\Repositories\ProductRepository;
use Omarfarhat0\TrainingProjectWarehouseInventory\Repositories\StockMovementRepository;
use Omarfarhat0\TrainingProjectWarehouseInventory\Repositories\SupplierRepository;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\ProductService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\StockMovementService;
use Omarfarhat0\TrainingProjectWarehouseInventory\Services\SupplierService;

$productRepository = new ProductRepository($db);
$productService = new ProductService($productRepository);
$productController = new ProductController($productService);

$supplierRepository = new SupplierRepository($db);
$supplierService = new SupplierService($supplierRepository);
$supplierController = new SupplierController($supplierService);

$stockMovementRepository = new StockMovementRepository($db);
$stockMovementService = new StockMovementService(
    $stockMovementRepository,
    $productRepository,
    $supplierRepository,
);
$stockMovementController = new StockMovementController($stockMovementService);

$router->get('/api/products', [$productController, 'index']);
$router->post('/api/products', [$productController, 'create'], CreateProductRequest::class);

$router->get('/api/suppliers', [$supplierController, 'index']);
$router->post('/api/suppliers', [$supplierController, 'create'], CreateSupplierRequest::class);

$router->get('/api/stock-movements', [$stockMovementController, 'index']);
$router->post('/api/stock-movements', [$stockMovementController, 'create'], CreateStockMovementRequest::class);
