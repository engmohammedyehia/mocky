<?php
namespace App\MockServer;

use App\Config\IConfig;
use App\Helpers;
use App\Logger\ILogger;
use App\Response\IResponse;
use App\Router\IRouter;
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
    /** @var string */
    private $version = '1.0.0';

    /** @var Server */
    private $server;

    /** @var IConfig */
    private $config;

    /** @var IResponse */
    private $response;

    /** @var IRouter */
    private $router;

    /** @var string */
    private $responseType = 'Default';
    /**
     * @var ILogger
     */
    private $logger;

    /**
     * MockServer constructor.
     * @param IRouter $router
     * @param IResponse $response
     * @param ILogger $logger
     */
    public function __construct(
        IRouter $router,
        IResponse $response,
        ILogger $logger
    ) {

        $this->router = $router;
        $this->config = $response->getConfig();
        $this->response = $response;
        $this->logger = $logger;

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
                printf('%s', Helpers::bootMessage($this));
            }
        );
    }

    /**
     * Listens to requests on the server
     */
    public function listen(): void
    {
        $this->handleRequests();
        @$this->getServer()->start();
    }

    /**
     * Handles incoming requests to the server
     */
    private function handleRequests(): void
    {
        $this->getServer()->on(
            'request',
            function (Request $request, Response $response) {
                $this->getMockServerResponse()->setEndPoint(
                    $this->getRouter()->getEndPoint($request)
                );

                $this->getMockServerResponse()->setResponseType(
                    $this->responseType
                );

                $responseObject = $this->getMockServerResponse()
                    ->buildResponse($response);

                $response->end($responseObject->getResponseData());

                $this->log($request, $responseObject);
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

    /**
     * Logs the HTTP request of logging is enabled in the configuration
     * @param Request $request
     * @param IResponse $responseObject
     */
    private function log(Request $request, IResponse $responseObject)
    {
        if ($this->getConfig()->isLoggingEnabled()) {
            $this->getLogger()->setRequest($request);
            $this->getLogger()->setResponse($responseObject);
            $this->getLogger()->logRequest();
        }
    }

    /**
     * @return IRouter
     */
    public function getRouter(): IRouter
    {
        return $this->router;
    }

    /**
     * @return ILogger
     */
    public function getLogger(): ILogger
    {
        return $this->logger;
    }
}
