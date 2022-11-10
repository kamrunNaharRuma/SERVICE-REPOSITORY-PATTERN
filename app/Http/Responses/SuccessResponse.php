<?php

namespace App\Http\Responses;

class SuccessResponse
{
    private string $message;
    private $data;
    private $statusCode;

    public function __construct(string $message, $data = null, $statusCode)
    {
        $this->data         = $data;
        $this->message      = $message;
        $this->statusCode   = $statusCode;
    }

    public function getPayload(): array
    {
        return [
            'success'       => true,
            'status_code'   => $this->statusCode,
            'message'       => $this->message,
            'data'          => $this->data
        ];
    }
}
