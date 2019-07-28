<?php
namespace App\Response;

use Swoole\Http\Response;
/**
 * Class IResponse
 * @package App\Response
 */
interface IResponse
{
    function sendResponse(Response $response): void;
}
