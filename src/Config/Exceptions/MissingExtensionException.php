<?php
namespace App\Config\Exceptions;

use Exception;
use Throwable;

/**
 * Class InvalidVersionException
 * @package App\Config\Exceptions
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
