<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

use Omarfarhat0\TrainingProjectWarehouseInventory\Validation\Validator;

abstract class ValidatableRequest extends Request {
    abstract protected function rules(): array;

    public function validate(): void {
        $body = $this->body();
        new Validator($body ?? [])->validate($this->rules());
    }
}
