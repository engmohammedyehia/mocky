<?php
namespace App\Response;

use Swoole\Http\Response;
/**
 * Class IResponse
 * @package App\Response
 */
interface IResponse
{
    function setEndPoint(string $endpoint): void;
    function getEndPoint(): string;
    function sendResponse(Response $response): void;
    function setResponseType(string $type): void;
    function getResponseType(): string;
}
