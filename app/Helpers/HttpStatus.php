<?php

namespace App\Helpers;

class HTTPStatus
{
    const SUCCESS = 200;
    const VALIDATION_ERROR = 422;
    const UNAUTHORIZE = 401;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const INTERNAL_SERVER_ERROR = 500;
}