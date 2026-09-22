<?php

return function (PDO $db): void {
    $db->exec("
        CREATE TABLE IF NOT EXISTS products (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            sku VARCHAR(100) NOT NULL UNIQUE,
            unit ENUM('piece', 'bag', 'kg', 'liter') NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )
    ");
};
