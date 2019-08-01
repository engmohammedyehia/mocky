<?php
namespace App\Config\Exceptions;

use Exception;

/**
 * Class InvalidVersionException
 * @package App\Config\Exceptions
 */
class MissingExtensionException extends Exception
{
    protected $message = 'Swoole Extension is required for the Server to run';
}
