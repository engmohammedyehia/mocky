<?php
namespace App\Logger;

use Swoole\Http\Request;

/**
 * Interface ILogger
 * @package App\Logger
 */
interface ILogger
{
    /**
     * Logs the HTTP request to the console
     * @return void
     */
    public function logRequest(): void;

    /**
     * Sets the Request Object to pass information to the logger
     * @param Request $request
     */
    public function setRequest(Request $request): void;
}
