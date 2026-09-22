<?php

use Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Response\Response;
use Omarfarhat0\TrainingProjectWarehouseInventory\Exceptions\AppException;

$app = require __DIR__ . '/../bootstrap/app.php';

try {
    $app();
} catch (AppException $e) {
    (new Response($e->getMessage(), $e->getCode()))->send();
} catch (Throwable $exception) {
    (new Response('something went wrong', 500))->send();
}
