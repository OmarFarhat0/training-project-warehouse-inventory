<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Services;

use Omarfarhat0\TrainingProjectWarehouseInventory\Contracts\SupplierRepositoryInterface;
use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

class SupplierService {
    public function __construct(private SupplierRepositoryInterface $supplierRepository) {}

    public function getAll(): array {
        return $this->supplierRepository->getAll();
    }

    public function create(array $attributes): array {
        if ($this->supplierRepository->existsByPhone($attributes['phone'])) {
            throw new AppException('Supplier with this phone already exists', 409);
        }

        return $this->supplierRepository->create($attributes);
    }
}
