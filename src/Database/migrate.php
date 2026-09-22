<?php

$db = new PDO("mysql:host=127.0.0.1;dbname=warehouse_inventory", "root", "");

$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$migrationsPath = __DIR__ . "/migrations";

$migrationsFiles = glob($migrationsPath . "/*.php");

foreach ($migrationsFiles as $migrationFile) {
    $migrationFunction = require $migrationFile;
    
    $migrationFunction($db);
}
