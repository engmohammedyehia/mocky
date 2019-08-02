<?php
namespace App\Logger;

use App\Response\Response;
use DateTime;
use Swoole\Http\Request;

/**
 * Class Logger
 * @package App\Logger
 */
class Logger implements ILogger
{
    /** @var Request */
    private $request;

    /** @var Response */
    private $response;

    /** @inheritDoc */
    public function logRequest(): void
    {
        $now = (new DateTime())->format('H:i:s');
        $requestAt = LoggerFormatter::colorizeString(
            " → Request details ",
            Colors::CONSOLE_FOREGROUND_COLOR_BLACK,
            Colors::CONSOLE_BACKGROUND_COLOR_YELLOW
        );
        $responseAt = LoggerFormatter::colorizeString(
            " ← Response details ",
            Colors::CONSOLE_FOREGROUND_COLOR_BLACK,
            Colors::CONSOLE_BACKGROUND_COLOR_GREEN
        );
        printf(
            "%s\n\nRequested at: %s\nProtocol: %s\nMethod: %s\nEndpoint: %s\nQuery String: %s\n\n%s\n\n%s\n\nStatus Code: %d\nBody:%s\n\n\n\n",
            $requestAt,
            $now,
            $this->getRequest()->server['server_protocol'],
            $this->getRequest()->server['request_method'],
            $this->getRequest()->server['path_info'],
            $this->getRequest()->server['query_string'] ?? 'null',
            $this->getRequest()->rawContent(),
            $responseAt,
            $this->getResponse()->getStatusCode(),
            $this->getResponse()->getResponseData() === '' ? 'null' : "\n" . $this->getResponse()->getResponseData()
        );
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param Request $request
     */
    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    /**
     * @return Response
     */
    public function getResponse(): Response
    {
        return $this->response;
    }

    /**
     * @param Response $response
     */
    public function setResponse(Response $response): void
    {
        $this->response = $response;
    }
}
