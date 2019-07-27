<?php
namespace App\MockServer;

use Swoole\Http\Server;

/**
 * Class MockServer
 * @package App\MockServer
 * @author Mohammed Abdoh <engmohammedyehia@hotmail.com>
 */
class MockServer
{
    /**
     * @var Server
     */
    private $server;

    /**
     * MockServer constructor.
     * @param string $ipAddress
     * @param int $portNumber
     */
    public function __construct(string $ipAddress, int $portNumber)
    {
        $this->server = new Server($ipAddress, $portNumber);
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
        $this->getServer()->start();
    }

    /**
     * @return Server
     */
    public function getServer(): Server
    {
        return $this->server;
    }
}
