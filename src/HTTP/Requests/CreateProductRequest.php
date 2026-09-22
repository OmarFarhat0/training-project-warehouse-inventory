<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

use Omarfarhat0\TrainingProjectWarehouseInventory\Enums\ProductUnit;

class CreateProductRequest extends ValidatableRequest {
    protected function rules(): array {
        return [
            'name' => ['required', 'string'],
            'sku' => ['required', 'string'],
            'unit' => [
                'required',
                'string',
                'in:' . implode(',', array_column(ProductUnit::cases(), 'value')),
            ],
        ];
    }
}
