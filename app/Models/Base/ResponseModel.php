<?php

namespace App\Models\Base;

use App\Helpers\HttpStatus;
use App\Helpers\HttpMessage;

class ResponseModel
{
    public $status_code = HttpStatus::SUCCESS;
    public $message = HttpMessage::SUCCESS_READ;
    public $data = null;

    public function __construct($statusCode = HttpStatus::SUCCESS, $message = HttpMessage::SUCCESS_READ)
    {
        if ($statusCode) $this->status_code = $statusCode;
        if ($message) $this->message = $message;
    }
}
