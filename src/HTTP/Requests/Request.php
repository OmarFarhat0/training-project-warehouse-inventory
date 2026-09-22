<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Requests;

class Request {
    public function body() {
        return json_decode(file_get_contents('php://input'), true);
    }
}
