<?php namespace Kpolicar\BackendLock\Exceptions;


use Symfony\Component\HttpKernel\Exception\HttpException;

class UnauthorizedException extends HttpException
{
    public function __construct(?string $message = '', \Throwable $previous = null, int $code = 0, array $headers = [])
    {
        parent::__construct(401, $message, $previous, $headers, $code);
    }
}
