<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

class CreateSupplierRequest extends ValidatableRequest {
    protected function rules(): array {
        return [
            'name' => ['required', 'string'],
            'phone' => ['required', 'string'],
        ];
    }
}
