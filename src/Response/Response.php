<?php
namespace App\Response;

use App\Config\IConfig;
use App\MockData\Employee;
use Symfony\Component\Yaml\Yaml;
use Swoole\Http\Response as SwooleResponse;

/**
 * Class Response
 * @package App\Config
 */
final class Response implements IResponse
{
    /** @var array */
    private $configuration;

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
        $response->end($this->getModelResponse());
    }

    private function prepareHeaders(SwooleResponse $response)
    {
        $response->header('Content-Type', 'application/json');
    }

    private function getModelResponse()
    {
        $response = new Employee();
        return $response->buildResponse();
    }
}
