<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions;

use Exception;

class AppException extends Exception {
    public function __construct(string $message, int $code = 500) {
        parent::__construct($message, $code);
    }
}
