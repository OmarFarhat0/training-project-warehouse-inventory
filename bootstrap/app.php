<?php

require __DIR__ . '/../vendor/autoload.php';

use Omarfarhat0\TrainingProjectWarehouseInventory\Routing\Router;

$db = new PDO("mysql:host=127.0.0.1;dbname=warehouse_inventory", "root", "");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$router = new Router();
require __DIR__ . '/../routes/api.php';

return function() use ($router): void {
    $httpMethod = $_SERVER['REQUEST_METHOD'];

    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $router->dispatch($httpMethod, $uri);
};
