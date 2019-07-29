<?php
namespace App\Response;

use App\Config\IConfig;
use Swoole\Http\Response;

/**
 * Class IResponse
 * @package App\Response
 */
interface IResponse
{
    public function setEndPoint(string $endpoint): void;
    public function getEndPoint(): string;
    public function sendResponse(Response $response): void;
    public function setResponseType(string $type): void;
    public function getResponseType(): string;
    public function getConfig(): IConfig;
}
