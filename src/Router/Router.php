<?php
namespace App\Router;

use App\Config\IConfig;
use Swoole\Http\Request;

/**
 * Interface IRoute
 * @package App\Router
 */
final class Router
{
    public function isRouteValid(
        Request $request,
        IConfig $config
    ) {

    }
}
