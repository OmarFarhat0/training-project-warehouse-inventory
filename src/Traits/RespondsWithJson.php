<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Traits;

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Response\Response;

trait RespondsWithJson {
    public function json (
        string $message, 
        int $statusCode = 200,
        mixed $data = null
    ): void {
        new Response($message, $statusCode, $data)->send();
    }
}