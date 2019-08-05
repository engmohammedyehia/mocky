<?php
namespace App\Logger;

use App\Response\IResponse;
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

    /**
     * Sets the Response Object to pass information to the logger
     * @param IResponse $response
     */
    public function setResponse(IResponse $response): void;
}
