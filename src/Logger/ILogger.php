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
    public function log(): void;
}
