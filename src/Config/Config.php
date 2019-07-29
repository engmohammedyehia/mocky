<?php
namespace App\Config;

use InvalidArgumentException;

/**
 * Class Config
 * @package App\Config
 */
final class Config implements IConfig
{
    use ConfigValidator;

    /**
     * @var string
     */
    private $ipAddress;
    /**
     * @var int
     */
    private $portNumber;
    /**
     * @var string
     */
    private $configFilePath;

    /** @var string */
    private $prefix = '';

    /** @var bool */
    private $logging = false;

    /** @var ConfigParser */
    private $configParser;

    /**
     * Config constructor.
     * @param string $ipAddress
     * @param int $portNumber
     * @param string $configFilePath
     * @param string $prefix
     * @param bool $logging
     */
    public function __construct(
        string $ipAddress,
        int $portNumber,
        string $configFilePath,
        string $prefix = '',
        bool $logging = false
    ) {
        $this->ipAddress = $ipAddress;
        $this->portNumber = $portNumber;
        $this->configFilePath = $configFilePath;
        $this->prefix = $prefix;
        $this->logging = $logging;
        try {
            $this->validateConfig();
            $this->createConfigParser();
        } catch (InvalidArgumentException $e) {
            sprintf(
                'Invalid configuration: %s',
                $e->getMessage()
            );
        }
    }

    private function createConfigParser(): void
    {
        $this->configParser = new ConfigParser($this->configFilePath);
    }

    /**
     * @return string
     */
    public function getIpAddress(): string
    {
        return $this->ipAddress;
    }

    /**
     * @return int
     */
    public function getPortNumber(): int
    {
        return $this->portNumber;
    }

    /**
     * @return string
     */
    public function getConfigFilePath(): string
    {
        return $this->configFilePath;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return bool
     */
    public function getLogging(): bool
    {
        return $this->logging;
    }

    /**
     * @return ConfigParser
     */
    public function getConfigParser(): ConfigParser
    {
        return $this->configParser;
    }
}
