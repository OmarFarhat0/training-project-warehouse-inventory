<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Services;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\ProductRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

class ProductService {
    public function __construct(private ProductRepositoryInterface $productRepository) {}

    public function getAll(): array {
        return $this->productRepository->getAll();
    }

    public function create(array $attributes): array {
        if ($this->productRepository->existsBySku($attributes['sku'])) {
            throw new AppException('Product with this sku already exists', 409);
        }

        return $this->productRepository->create($attributes);
    }
}
