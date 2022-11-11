<?php

namespace App\Http\Responses;

use Exception;

class ApiException extends Exception
{

    public function __construct(string $message = "Server Error", int $statusCode = 500)
    {
        $message      = $message;
        $statusCode   = $statusCode;
        parent::__construct($message, $statusCode);
    }
}
