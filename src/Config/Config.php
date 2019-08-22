<?php
namespace App\Config;

use App\Config\Exceptions\InvalidVersionException;
use App\Config\Exceptions\MissingExtensionException;
use InvalidArgumentException;

/**
 * Class Config
 * @package App\Config
 */
final class Config implements IConfig
{
    use ConfigValidator;

    /** @var string */
    private $ipAddress;

    /** @var int */
    private $portNumber;

    /** @var string */
    private $configFilePath;

    /** @var string */
    private $prefix = '';

    /** @var bool */
    private $logging = false;

    /** @var ConfigParser */
    private $configParser;

    /** @var array */
    private $options;

    /**
     * Config constructor.
     * @param string $ipAddress
     * @param int $portNumber
     * @param string $configFilePath
     * @param array $options
     */
    public function __construct(
        string $ipAddress,
        int $portNumber,
        string $configFilePath,
        array $options
    ) {
        $this->ipAddress = $ipAddress;
        $this->portNumber = $portNumber;
        $this->configFilePath = $configFilePath;
        $this->options = $options;

        try {
            $this->validateConfig();
            $this->createConfigParser();
            $this->buildExtraConfiguration();
        } catch (InvalidArgumentException $e) {
            sprintf(
                'Invalid configuration: %s',
                $e->getMessage()
            );
        }
    }

    /**
     * Creates an instance of the configuration parser
     */
    private function createConfigParser(): void
    {
        $this->configParser = new ConfigParser($this->configFilePath);
    }

    /**
     * Collect other configuration values
     */
    private function buildExtraConfiguration()
    {
        if (!empty($this->getOptions())) {
            foreach ($this->getOptions() as $option => $value) {
                $this->$option = $value;
            }
        }
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
    public function isLoggingEnabled(): bool
    {
        return (bool) $this->getOptions()['logging'];
    }

    /**
     * @return ConfigParser
     */
    public function getConfigParser(): ConfigParser
    {
        return $this->configParser;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    /**
     * Return a list of enabled loggers if logging is enabled
     * @return array
     */
    public function getRequestedLoggers(): array
    {
        return explode(',', $this->getOptions()['logging']);
    }
}
