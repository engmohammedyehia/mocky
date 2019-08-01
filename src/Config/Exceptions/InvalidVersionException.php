<?php
namespace App\Config\Exceptions;

use Exception;

/**
 * Class InvalidVersionException
 * @package App\Config\Exceptions
 */
class InvalidVersionException extends Exception
{
    protected $message = 'PHP version is in-compatible with the Server';
}
