<?php

return function (PDO $db): void {
    $db->exec("
        CREATE TABLE IF NOT EXISTS stock_movements (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product_id INT UNSIGNED NOT NULL,
            type ENUM('in', 'out') NOT NULL,
            quantity DECIMAL(10, 2) NOT NULL,
            supplier_id INT UNSIGNED NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (product_id) REFERENCES products(id),
            FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
        )
    ");
};
