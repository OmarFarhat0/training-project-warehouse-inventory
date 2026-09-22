<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Database;

use PDO;
use DateTime;

class QueryBuilder {
    
    private array $conditions = [];
    private array $values = [];

    public function __construct(private PDO $db, private string $table) {}

    public function where (string $column, string $operator, mixed $value) {
        $this->conditions[] = "{$column} {$operator} ?";
        $this->values[] = $value instanceof DateTime ? $value->format('Y-m-d H:i:s') : $value;
        return $this;
    }

    public function exists(): bool {
        $where = "";

        if ($this->conditions) {
            $where = "WHERE " . implode(" AND ", $this->conditions);
        }

        $sql = "SELECT 1 FROM {$this->table} {$where} LIMIT 1";

        $statement = $this->db->prepare($sql);
        $statement->execute($this->values);

        return $statement->fetchColumn() !== false;
    } 

    public function create(array $attributes): int {
        $columns = implode(', ', array_keys($attributes));

        $placeholders = implode(', ', array_fill(0, count($attributes), '?'));

        $sql = "INSERT INTO {$this->table} ({$columns}) VALUES ({$placeholders})";

        $statement = $this->db->prepare($sql);
        $statement->execute(array_values($attributes));

        return (int) $this->db->lastInsertId();
    }

    public function update(int $id, array $attributes): array {
        $columns = implode(
            ', ',
            array_map(fn($column) => "{$column} = ?", array_keys($attributes)),
        );

        $values = array_values($attributes);
        $values[] = $id;

        $sql = "UPDATE {$this->table} SET {$columns} WHERE id = ?";

        $statement = $this->db->prepare($sql);
        $statement->execute($values);

        return $this->where('id', '=', $id)->get()[0] ?? [];
    }

    public function get() {
        $where = "";

        if ($this->conditions) {
            $where = "WHERE " . implode(" AND ", $this->conditions);
        }

        $sql = "SELECT * FROM {$this->table} {$where}";

        $statement = $this->db->prepare($sql);
        $statement->execute($this->values);

        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }
}
