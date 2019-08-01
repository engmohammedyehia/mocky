<?php
namespace App\Logger;

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

    /** @inheritDoc */
    public function logRequest(): void
    {
        $now = (new DateTime())->format('H:i:s');
        printf(
            "# Request at (%s): %s %s\n",
            $now,
            $this->getRequest()->server['request_method'],
            $this->getRequest()->server['path_info']
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
}
