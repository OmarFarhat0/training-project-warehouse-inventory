<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Validation;

use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

class Validator {
    
    public function __construct(private array $data) {}

    public function validate(array $rules): void {
        foreach ($rules as $field => $fieldRules) {
            $value = $this->data[$field] ?? null;
            $isRequired = in_array('required', $fieldRules, true);

            if (!$isRequired && ($value === null || $value === '')) {
                continue;
            }

            foreach ($fieldRules as $rule) {

                [$ruleName, $parameter] = array_pad(
                    explode(':', $rule, 2),
                    2,
                    null
                );

                switch ($ruleName) {
                    case 'required':
                        $this->validateRequired($field, $value);
                        break;

                    case 'string':
                        $this->validateString($field, $value);
                        break;

                    case 'date':
                        $this->validateDate($field, $value);
                        break;

                    case 'in':
                        $this->validateIn($field, $value, $parameter);
                        break;

                    case 'bool':
                        $this->validateBool($field, $value);
                        break;

                    case 'integer':
                        $this->validateInteger($field, $value);
                        break;

                    case 'numeric':
                        $this->validateNumeric($field, $value);
                        break;

                    case 'gt':
                        $this->validateGreaterThan($field, $value, $parameter);
                        break;
                }
            }
        }
    }

    private function validateRequired(string $field, mixed $value): void {
        if ($value === null || $value === "") {
            throw new AppException("The field {$field} is required", 422);
        }
    }

    private function validateString(string $field, mixed $value): void {
        if (!is_string($value)) {
            throw new AppException("The field {$field} must be a string", 422);
        }
    }

    private function validateDate(string $field, mixed $value): void {
        if (!is_string($value) || strtotime($value) === false) {
            throw new AppException("The field {$field} must be a valid date", 422);
        }
    }

    private function validateBool(string $field, mixed $value): void {
        if (!is_bool($value)) {
            throw new AppException("The field {$field} must be a boolean", 422);
        }
    }

    private function validateIn(
        string $field,
        mixed $value,
        ?string $parameter
    ): void {

        $allowedValues = explode(',', $parameter ?? '');

       if (!in_array($value, $allowedValues, true)) {
            throw new AppException(
                "The field {$field} must be one of the following values: " . implode(', ', $allowedValues),
                422
            );
        }
    }

    private function validateInteger(string $field, mixed $value): void {
        if (!is_int($value)) {
            throw new AppException("The field {$field} must be an integer", 422);
        }
    }

    private function validateNumeric(string $field, mixed $value): void {
        if (!is_int($value) && !is_float($value)) {
            throw new AppException("The field {$field} must be a number", 422);
        }
    }

    private function validateGreaterThan(string $field, mixed $value, ?string $parameter): void {
        if (!is_numeric($value) || !is_numeric($parameter) || (float) $value <= (float) $parameter) {
            throw new AppException("The field {$field} must be greater than {$parameter}", 422);
        }
    }
}
