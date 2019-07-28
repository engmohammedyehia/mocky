<?php
namespace App\Response;

use App\Config\ConfigValidator;
use App\Config\IConfig;
use App\MockData\Employee;
use App\MockData\IMockData;
use Symfony\Component\Yaml\Yaml;
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
    const DEFAULT_RESPONSE_TYPE = 'success';

    /** @var int */
    const DEFAULT_STATUS_CODE = 200;

    /** @var array */
    private $configuration;

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
        $this->configuration = Yaml::parseFile($config->getConfigFilePath());
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function sendResponse(SwooleResponse $response): void
    {
        $this->prepareHeaders($response);
        $this->setStatusCode($response);
        $response->end($this->getModelResponse());
    }

    private function prepareHeaders(SwooleResponse $response)
    {
        $headers = $this->extractResponseHeader();
        if(!empty($headers)) {
            foreach ($headers[0] as $headerName => $value) {
                if($this->validateHeaders($headerName)) {
                    $response->header($headerName, $value);
                }
            }
        }
    }

    private function setStatusCode(SwooleResponse $response)
    {
        $response->status($this->extractStatusCode());
    }

    private function getModelResponse()
    {
        $model = $this->getConfiguration()['endpoints']
        [$this->getEndpoint()]['responses']
        [$this->getResponseType()]['model'];

        /** @var IMockData $response */
        $response = new $model();
        return $response->buildResponse($this->getResponseType());
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
        if(!array_key_exists(
            $endpoint,
            $this->getConfiguration()['endpoints'])
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
        if(!array_key_exists(
            $responseType,
            $this->getConfiguration()['endpoints'][$this->getEndpoint()]['responses'])
        ) {
            $this->endpoint = self::DEFAULT_ENDPOINT;
            $this->responseType = self::DEFAULT_RESPONSE_TYPE;
        } else {
            $this->responseType = $responseType;
        }
    }

    private function extractResponseHeader(): ?array
    {
        if(array_key_exists('headers', $this->getResponseArray())){
            return $this->getResponseArray()['headers'];
        }

        return [];
    }

    private function extractStatusCode(): int
    {
        if(array_key_exists('status', $this->getResponseArray())){
            return $this->getResponseArray()['status'];
        }

        return self::DEFAULT_STATUS_CODE;
    }

    private function getResponseArray(): array
    {
        return $this->getConfiguration()['endpoints']
        [$this->getEndpoint()]['responses']
        [$this->getResponseType()];
    }
}
