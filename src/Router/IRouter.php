<?php
namespace App\Router;

use App\Config\IConfig;
use Swoole\Http\Request;

/**
 * Interface IRouter
 * @package App\Router
 */
interface IRouter
{
    public function getMethod(Request $request): string;
    public function getPath(Request $request): string;
    public function getEndPoint(Request $request): string;
}
