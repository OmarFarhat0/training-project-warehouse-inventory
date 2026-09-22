<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Services;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductSupplierRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\SupplierRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

class ProductSupplierService {
    public function __construct(
        private ProductSupplierRepositoryInterface $productSupplierRepository,
        private ProductRepositoryInterface $productRepository,
        private SupplierRepositoryInterface $supplierRepository,
    ) {}

    public function getAll(): array {
        return $this->productSupplierRepository->getAll();
    }

    public function create(array $attributes): array {
        if (!$this->productRepository->getById($attributes['product_id'])) {
            throw new AppException('Product not found', 404);
        }

        if (!$this->supplierRepository->getById($attributes['supplier_id'])) {
            throw new AppException('Supplier not found', 404);
        }

        if ($this->productSupplierRepository->existsByProductAndSupplier(
            $attributes['product_id'],
            $attributes['supplier_id'],
        )) {
            throw new AppException('Product supplier link already exists', 409);
        }

        return $this->productSupplierRepository->create($attributes);
    }
}
