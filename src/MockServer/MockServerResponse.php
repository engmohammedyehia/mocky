<?php
namespace App\Config;

use Symfony\Component\Yaml\Yaml;

/**
 * Class MockServerResponse
 * @package App\Config
 */
final class MockServerResponse
{
    /** @var array */
    private $configuration;

    /**
     * MockServerResponse constructor.
     * @param string $configFile
     */
    public function __construct(string $configFile)
    {
        $this->configuration = Yaml::parseFile($configFile);
    }

    /**
     * @return array
     */
    public function getConfiguration(): array
    {
        return $this->configuration;
    }

    public function buildResponse()
    {

    }
}
