<?php
namespace App\Logger\Decorators;

use App\Logger\ILogger;

/**
 * Class LoggerDecorator
 * @package App\Logger\Decorators
 */
class LoggerDecorator implements ILogger
{
    /**
     * @var ILogger
     */
    private $decoratedObject;

    /**
     * LoggerDecorator constructor.
     * @param ILogger $decoratedObject
     */
    public function __construct(ILogger $decoratedObject)
    {
        $this->decoratedObject = $decoratedObject;
    }

    /**
     * Logs the HTTP request to the console
     * @return void
     */
    public function log(): void
    {
        $this->decoratedObject->log();
    }
}
