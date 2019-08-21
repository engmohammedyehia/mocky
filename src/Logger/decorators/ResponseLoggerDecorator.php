<?php
namespace App\Logger\decorators;

use App\Logger\ILogger;
use App\Logger\Formatter\Colors;
use App\Logger\Formatter\LoggerFormatter;
use App\Response\IResponse;
use Exception;

/**
 * Class RequestLoggerDecorator
 * @package App\Logger\decorators
 */
class ResponseLoggerDecorator extends LoggerDecorator
{
    /** @var IResponse */
    private $response;

    /**
     * ResponseLoggerDecorator constructor.
     * @param ILogger $decoratedObject
     * @param IResponse $response
     */
    public function __construct(ILogger $decoratedObject, IResponse $response)
    {
        $this->response = $response;
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
        $responseAt = LoggerFormatter::colorizeString(
            " ← Response details ",
            Colors::CONSOLE_FOREGROUND_COLOR_BLACK,
            Colors::CONSOLE_BACKGROUND_COLOR_GREEN
        );
        printf(
            "%s\n\nStatus Code: %d\nBody:%s\n\n\n\n",
            $responseAt,
            $this->getResponse()->getStatusCode(),
            $this->getResponse()->getResponseData() === '' ?
                'null' : "\n" . $this->getResponse()->getResponseData()
        );
    }

    /**
     * @return IResponse
     */
    public function getResponse(): IResponse
    {
        return $this->response;
    }
}
