<?php
namespace App\Response;

use App\Config\IConfig;
use App\Logger\ILogger;
use Swoole\Http\Response;

/**
 * Class IResponse
 * @package App\Response
 */
interface IResponse
{
    public function setEndPoint(string $endpoint): void;
    public function getEndPoint(): string;
    public function sendResponse(Response $response, ILogger $logger): void;
    public function setResponseType(string $type): void;
    public function getResponseType(): string;
    public function getConfig(): IConfig;
    public function getResponseData(): string;
    public function setResponseData(string $responseData): void;
}
