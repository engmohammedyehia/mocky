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
    /**
     * Extracts the HTTP method used to request the resource
     * @param Request $request
     * @return string
     */
    public function getMethod(Request $request): string;

    /**
     * Extracts the URL Path of the request
     * @param Request $request
     * @return string
     */
    public function getPath(Request $request): string;

    /**
     * Builds the requested endpoint according to the YAML config
     * specification (METHOD/PATH)
     * @example GET/employees
     * @param Request $request
     * @return string
     */
    public function getEndPoint(Request $request): string;
}
