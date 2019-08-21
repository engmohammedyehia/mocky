<?php
namespace App\Logger\decorators;

use App\Logger\ILogger;
use App\Logger\Formatter\Colors;
use App\Logger\Formatter\LoggerFormatter;
use Exception;
use Swoole\Http\Request;

/**
 * Class RequestLoggerDecorator
 * @package App\Logger\decorators
 */
class RequestLoggerDecorator extends LoggerDecorator
{
    /** @var Request */
    private $request;

    /**
     * RequestLoggerDecorator constructor.
     * @param ILogger $decoratedObject
     * @param Request $request
     */
    public function __construct(ILogger $decoratedObject, Request $request)
    {
        $this->request = $request;
        parent::__construct($decoratedObject);
    }

    /**
     * Logs the HTTP request to the console
     * @return void
     * @throws Exception
     */
    public function log(): void
    {
        parent::log();
        $requestAt = LoggerFormatter::colorizeString(
            " → Request details ",
            Colors::CONSOLE_FOREGROUND_COLOR_BLACK,
            Colors::CONSOLE_BACKGROUND_COLOR_YELLOW
        );
        printf(
            "%s\n\nProtocol: %s\nMethod: %s\nEndpoint: %s\nQuery String: %s\n\n%s\n\n",
            $requestAt,
            $this->getRequest()->server['server_protocol'],
            $this->getRequest()->server['request_method'],
            $this->getRequest()->server['path_info'],
            $this->getRequest()->server['query_string'] ?? 'null',
            $this->getRequest()->rawContent()
        );
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }
}
