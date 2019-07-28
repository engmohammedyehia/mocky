<?php
namespace App\MockServer;

use App\Config\IConfig;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

/**
 * Class MockServer
 * @package App\MockServer
 * @author Mohammed Abdoh <engmohammedyehia@hotmail.com>
 */
final class MockServer
{
    /**
     * @var int
     */
    private $version = 1;

    /**
     * @var Server
     */
    private $server;
    /**
     * @var IConfig
     */
    private $config;

    /**
     * MockServer constructor.
     * @param IConfig $config
     */
    public function __construct(
        IConfig $config
    ) {
        $this->config = $config;
        $this->startServer();
    }

    /**
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }

    /**
     * @return int
     */
    public function getVersion(): int
    {
        return $this->version;
    }

    /**
     * @return IConfig
     */
    public function getConfig(): IConfig
    {
        return $this->config;
    }

    /**
     * Starts the Swoole HTTP Server
     */
    private function startServer()
    {
        $this->server = new Server(
            $this->getConfig()->getIpAddress(),
            $this->getConfig()->getPortNumber()
        );

        $this->getServer()->on(
            'start',
            function () {
                printf(
                    'Server started listening at %s on %d',
                    $this->getServer()->host,
                    $this->getServer()->port
                );
            }
        );
    }

    /**
     * Listens to requests on the server
     */
    public function listen(): void
    {
        $this->getServer()->on(
            'request',
            function(Request $request, Response $response) {
                $response->header('Content-Type', 'application/json');
                $response->end(json_encode([1,2,3,4], JSON_PRETTY_PRINT));
            }
        );
        $this->getServer()->start();
    }
}
