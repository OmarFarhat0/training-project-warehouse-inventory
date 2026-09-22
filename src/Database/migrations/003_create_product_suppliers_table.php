<?php

return function (PDO $db): void {
    $db->exec("
        CREATE TABLE IF NOT EXISTS product_suppliers (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            product_id INT UNSIGNED NOT NULL,
            supplier_id INT UNSIGNED NOT NULL,
            purchase_price DECIMAL(10, 2) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY unique_product_supplier (product_id, supplier_id),
            FOREIGN KEY (product_id) REFERENCES products(id),
            FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
        )
    ");
};
