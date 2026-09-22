<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

class CreateProductSupplierRequest extends ValidatableRequest {
    protected function rules(): array {
        return [
            'product_id' => ['required', 'integer'],
            'supplier_id' => ['required', 'integer'],
            'purchase_price' => ['required', 'numeric'],
        ];
    }
}
