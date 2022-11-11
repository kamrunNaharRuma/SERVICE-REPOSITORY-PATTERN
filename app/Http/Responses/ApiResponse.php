<?php

namespace App\Http\Responses;

class ApiResponse
{
    private string $message;
    private $data;
    private $statusCode;
    private $isSuccessful;

    public function __construct(string $message, $data, $statusCode, $isSuccessful)
    {
        $this->data         = $data;
        $this->message      = $message;
        $this->statusCode   = $statusCode;
        $this->isSuccessful   = $isSuccessful;
    }

    public function getPayload(): array
    {
        return [
            'success'       => $this->isSuccessful,
            'status_code'   => $this->statusCode,
            'message'       => $this->message,
            'data'          => $this->data
        ];
    }
}
