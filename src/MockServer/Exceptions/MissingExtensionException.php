<?php
namespace App\MockServer\Exceptions;

use Exception;
use Throwable;

/**
 * Class MissingExtensionException
 * @package App\MockServer\Exceptions
 */
class MissingExtensionException extends Exception
{
    public function __construct(
        $message = "Swoole Extension is required for the Server to run",
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
