<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

use Omarfarhat0\TrainingProjectWarehouseInventory\Enums\StockMovementType;

class CreateStockMovementRequest extends ValidatableRequest {
    protected function rules(): array {
        $supplierRules = ['integer'];

        if (($this->body()['type'] ?? null) === StockMovementType::IN->value) {
            $supplierRules = ['required', 'integer'];
        }

        return [
            'product_id' => ['required', 'integer'],
            'type' => [
                'required',
                'string',
                'in:' . implode(',', array_column(StockMovementType::cases(), 'value')),
            ],
            'quantity' => ['required', 'numeric', 'gt:0'],
            'unit_price' => ['required', 'numeric'],
            'supplier_id' => $supplierRules,
        ];
    }
}
