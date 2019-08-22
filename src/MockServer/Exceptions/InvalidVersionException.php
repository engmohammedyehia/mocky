<?php
namespace App\MockServer\Exceptions;

use Exception;
use Throwable;

/**
 * Class InvalidVersionException
 * @package App\MockServer\Exceptions
 */
class InvalidVersionException extends Exception
{
    public function __construct(
        $message = "'PHP version is in-compatible with the Server'",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
