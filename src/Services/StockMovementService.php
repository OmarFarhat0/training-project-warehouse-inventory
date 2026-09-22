<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Services;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\StockMovementRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\SupplierRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Enums\StockMovementType;
use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

class StockMovementService {
    public function __construct(
        private StockMovementRepositoryInterface $stockMovementRepository,
        private ProductRepositoryInterface $productRepository,
        private SupplierRepositoryInterface $supplierRepository,
    ) {}

    public function getAll(): array {
        return $this->stockMovementRepository->getAll();
    }

    public function create(array $attributes): array {
        $product = $this->productRepository->getById($attributes['product_id']);

        if (!$product) {
            throw new AppException('Product not found', 404);
        }

        if (isset($attributes['supplier_id'])) {
            $supplier = $this->supplierRepository->getById($attributes['supplier_id']);

            if (!$supplier) {
                throw new AppException('Supplier not found', 404);
            }
        }

        $currentQuantity = (float) $product['quantity'];
        $movementQuantity = (float) $attributes['quantity'];

        if ($attributes['type'] === StockMovementType::OUT->value) {
            if ($currentQuantity < $movementQuantity) {
                throw new AppException('Insufficient stock quantity', 422);
            }

            $newQuantity = $currentQuantity - $movementQuantity;
        } else {
            $newQuantity = $currentQuantity + $movementQuantity;
        }

        $movement = $this->stockMovementRepository->create($attributes);

        $this->productRepository->update((int) $product['id'], [
            'quantity' => $newQuantity,
        ]);

        return $movement;
    }
}
