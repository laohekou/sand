<?php


namespace Xyu\Sand\Exception;

use Throwable;

class UnauthorizedException extends SandException
{

    protected $statusCode = 401;

    public function __construct(string $message, Throwable $previous = null)
    {
        parent::__construct($message, 401, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
}
