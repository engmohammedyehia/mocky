<?php
namespace App\Router;

use Swoole\Http\Request;

/**
 * Interface IRoute
 * @package App\Router
 */
final class Router implements IRouter
{
    public function getMethod(Request $request): string
    {
        return $request->server['request_method'];
    }

    public function getPath(Request $request): string
    {
        return $request->server['path_info'];
    }

    public function getEndPoint(Request $request): string
    {
        return $this->getMethod($request).$this->getPath($request);
    }
}
