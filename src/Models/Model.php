<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\Models;

abstract class Model {

    protected ?int $id = null;

    public function __construct(?int $id) {
        $this->id = $id;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }
}
