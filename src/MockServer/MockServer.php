<?php
namespace App\MockServer;

use App\Config\IConfig;
use App\Response\IResponse;
use App\Router\IRouter;
use DateTime;
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
     * @var string
     */
    private $version = '1.0.0';

    /**
     * @var Server
     */
    private $server;

    /**
     * @var IConfig
     */
    private $config;

    /**
     * @var IResponse
     */
    private $response;

    /** @var IRouter */
    private $router;

    /** @var string */
    private $responseType = 'Default';

    /**
     * MockServer constructor.
     * @param IRouter $router
     * @param IResponse $response
     */
    public function __construct(
        IRouter $router,
        IResponse $response
    ) {
        $this->router = $router;
        $this->config = $response->getConfig();
        $this->response = $response;
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
     * @return string
     */
    public function getVersion(): string
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
                printf('[0;32;m%s', $this->welcome());
            }
        );
    }

    /**
     * Listens to requests on the server
     */
    public function listen(): void
    {
        $this->handleRequests();
        $this->getServer()->start();
    }

    /**
     * Handles incoming requests to the server
     */
    private function handleRequests(): void
    {
        $this->getServer()->on(
            'request',
            function(Request $request, Response $response) {
                $this->getMockServerResponse()->setEndPoint(
                    $this->getRouter()->getEndPoint($request)
                );
                $this->getMockServerResponse()->setResponseType(
                    $this->responseType
                );
                $this->getMockServerResponse()->sendResponse($response);
                $this->logRequest($request);
            }
        );
    }

    /**
     * @return IResponse
     */
    public function getMockServerResponse(): IResponse
    {
        return $this->response;
    }

    // TODO: Encapsulate this into a helper function
    private function welcome()
    {
        $tl = html_entity_decode('╔', ENT_NOQUOTES, 'UTF-8');
        $tr = html_entity_decode('╗', ENT_NOQUOTES, 'UTF-8');
        $bl = html_entity_decode('╚', ENT_NOQUOTES, 'UTF-8');
        $br = html_entity_decode('╝', ENT_NOQUOTES, 'UTF-8');
        $v = html_entity_decode('║', ENT_NOQUOTES, 'UTF-8');
        $h = html_entity_decode('═', ENT_NOQUOTES, 'UTF-8');

        return
            "\n".
            $tl.
            str_repeat($h, 35).
            $tr.
            "\n".
            $v.'                                   '.$v.
            "\n".
            $v.
            '  Mock Server started at ' .
            (new DateTime())->format('H:i:s').'  '.$v."\n".$v.'                                   '.$v.
            "\n".$v.
            '  Server Version: ' . $this->getVersion().'            '.$v."\n".$v.
            '  Server IP Address: ' . $this->getServer()->host.'       '.$v."\n".$v.
            '  Port Number: ' . $this->getServer()->port.'                '.$v."\n".$v.
            '  Server URL: http://' . $this->getServer()->host.':'.
            $this->getServer()->port . '  '.$v."\n".$v.'                                   '.$v."\n".
            $v.'  Enjoy ;)                         '.$v."\n".$v.'                                   '.$v."\n".
            $bl . str_repeat($h, 35)  . $br . "\n";
    }

    // TODO: Define a configuration option to debug requests in next version
    private function logRequest(Request $request)
    {
        if ($this->getConfig()->getLogging()) {
            $now = (new DateTime())->format('H:i:s');
            printf(
                "# Request at (%s): %s %s\n",
                $now,
                $request->server['request_method'],
                $request->server['path_info']
            );
        }
    }

    /**
     * @return IRouter
     */
    private function getRouter(): IRouter
    {
        return $this->router;
    }
}
