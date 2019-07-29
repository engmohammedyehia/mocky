<?php
namespace App\Response;

use App\Config\ConfigValidator;
use App\Config\IConfig;
use Swoole\Http\Response as SwooleResponse;

/**
 * Class Response
 * @package App\Config
 */
final class Response implements IResponse
{
    use ConfigValidator;

    /** @var string */
    const DEFAULT_ENDPOINT = 'GET/notfound';

    /** @var string */
    const DEFAULT_RESPONSE_TYPE = 'Default';

    /** @var int */
    const DEFAULT_STATUS_CODE = 200;

    /** @var IConfig */
    private $config;

    /** @var string */
    private $endpoint;

    /** @var string */
    private $responseType;

    /**
     * Response constructor.
     * @param IConfig $config
     */
    public function __construct(IConfig $config)
    {
        $this->config = $config;
    }

    /**
     * Send back a response to the Client
     * @param SwooleResponse $response
     */
    public function sendResponse(SwooleResponse $response): void
    {
        $this->prepareHeaders($response);
        $this->setStatusCode($response);
        $response->end(
            $this->getConfig()
                ->getConfigParser()
                ->getModelResponse($this)
        );
    }

    /**
     * Sets the response headers
     * @param SwooleResponse $response
     */
    private function prepareHeaders(SwooleResponse $response)
    {
        $headers = $this->getConfig()
            ->getConfigParser()
            ->extractResponseHeaders($this);
        if (!empty($headers)) {
            foreach ($headers[0] as $headerName => $value) {
                if ($this->validateHeader($headerName)) {
                    $response->header($headerName, $value);
                }
            }
        }
    }

    /**
     * Sets the response status code
     * @param SwooleResponse $response
     */
    private function setStatusCode(SwooleResponse $response)
    {
        $response->status(
            $this->getConfig()
                ->getConfigParser()
                ->extractStatusCode($this)
        );
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     */
    public function setEndpoint(string $endpoint): void
    {
        if (!array_key_exists(
            $endpoint,
            $this->getConfig()->getConfigParser()->getConfigData()['endpoints']
        )
        ) {
            $this->endpoint = self::DEFAULT_ENDPOINT;
        } else {
            $this->endpoint = $endpoint;
        }
    }

    /**
     * @return string
     */
    public function getResponseType(): string
    {
        return $this->responseType;
    }

    /**
     * @param string $responseType
     */
    public function setResponseType(string $responseType): void
    {
        if (!array_key_exists(
            $responseType,
            $this->getConfig()->getConfigParser()->getConfigData()['endpoints'][$this->getEndpoint()]['responses']
        )
        ) {
            $this->endpoint = self::DEFAULT_ENDPOINT;
            $this->responseType = self::DEFAULT_RESPONSE_TYPE;
        } else {
            $this->responseType = $responseType;
        }
    }

    /**
     * @return IConfig
     */
    public function getConfig(): IConfig
    {
        return $this->config;
    }
}
