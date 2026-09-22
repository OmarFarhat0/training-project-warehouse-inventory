<?php

namespace Omarfarhat0\TrainingProjectWarehouseInventory\HTTP\Response;

class Response {

    public bool $isSuccess;

    public function __construct(
        private string $message,
        private int $statusCode = 500,
        private mixed $data = null
    ) {}

    public function send(): void {
        http_response_code($this->statusCode);

        $response = [
            'isSuccess' => $this->isSuccess(),
            'message' => $this->message,
            'statusCode' => $this->statusCode
        ];

        if ($this->isSuccess()) {
            $response['data'] = $this->data;
        }

        echo json_encode($response);
    }

    public function isSuccess(): bool {
        return $this->statusCode >= 200 && $this->statusCode < 300;
    }
}
