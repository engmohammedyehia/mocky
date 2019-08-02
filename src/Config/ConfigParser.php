<?php
namespace App\Config;

use App\MockData\IMockData;
use App\Response\IResponse;
use App\Response\Response;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ConfigParser
 * @package App\Config
 */
final class ConfigParser
{
    /** @var array */
    private $configData;

    /**
     * ConfigParser constructor.
     * @param string $configFile
     */
    public function __construct(string $configFile)
    {
        $this->configData = Yaml::parseFile($configFile);
    }

    /**
     * Get a list of response header for the requested endpoint
     * @param IResponse $response
     * @return array|null
     */
    public function extractResponseHeaders(IResponse $response): ?array
    {
        if (array_key_exists('headers', $this->getEndpointResponse($response))) {
            return $this->getEndpointResponse($response)['headers'];
        }

        return [];
    }

    /**
     * Get the status code of the current response
     * @param IResponse $response
     * @return int
     */
    public function extractStatusCode(IResponse $response): int
    {
        if (array_key_exists('status', $this->getEndpointResponse($response))) {
            return $this->getEndpointResponse($response)['status'];
        }

        /** @var Response $response */
        return $response::DEFAULT_STATUS_CODE;
    }

    /**
     * Returns the current response array of the requested endpoint
     * @param IResponse $response
     * @return array
     */
    public function getEndpointResponse(IResponse $response): array
    {
        return $this->getConfigData()
        ['endpoints'][$response->getEndPoint()]
        ['responses'][$response->getResponseType()];
    }

    /**
     * Get the mock data model response to send it to the client
     * @param IResponse $response
     * @return string
     */
    public function getModelResponse(IResponse $response)
    {
        $model = $this->getConfigData()['endpoints']
        [$response->getEndPoint()]['responses']
        [$response->getResponseType()]['model'];

        // TODO: This piece of code doesn't belong here apply SRP by moving it to Response Class
        /** @var IMockData $responseData */
        $responseData = new $model();
        return $responseData->buildResponse($response->getResponseType());
    }

    /**
     * @return array
     */
    public function getConfigData(): array
    {
        return $this->configData;
    }
}
