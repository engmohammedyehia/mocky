<?php
namespace App\Config;

use InvalidArgumentException;

/**
 * Class Config
 * @package App\Config
 */
final class Config implements IConfig
{
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

    /**
     * Config constructor.
     * @param string $ipAddress
     * @param int $portNumber
     * @param string $configFilePath
     */
    public function __construct(
        string $ipAddress,
        int $portNumber,
        string $configFilePath
    ) {
        $this->ipAddress = $ipAddress;
        $this->portNumber = $portNumber;
        $this->configFilePath = $configFilePath;
        try {
            $this->validateConfig();
        } catch (InvalidArgumentException $e) {
            die(
                sprintf(
                    'Invalid configuration: %s',
                    $e->getMessage()
                )
            );
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
     * Validates the configuration
     * @return bool
     * @throws InvalidArgumentException
     */
    public function validateConfig(): bool
    {
        return $this->validateIpAddress() &&
            $this->validateConfigFile();
    }

    /**
     * Check if IP Address is valid
     * @return bool
     * @throws InvalidArgumentException
     */
    private function validateIpAddress(): bool
    {
        if(!filter_var(
            $this->getIpAddress(),
            FILTER_VALIDATE_IP
        )) {
            throw new InvalidArgumentException(
                sprintf(
                    "The IP address (%s) format is invalid\n",
                    $this->getIpAddress()
                )
            );
        };
        return true;
    }

    /**
     * Check if the configuration file exists and is readable
     * @return bool
     * @throws InvalidArgumentException
     */
    private function validateConfigFile(): bool
    {
        if(!file_exists($this->getConfigFilePath()) ||
            !is_readable($this->getConfigFilePath())) {
            throw new InvalidArgumentException(
                sprintf(
                    "Config file (%s) does not exist of is non-readable\n",
                    $this->getConfigFilePath()
                )
            );
        }
        return true;
    }
}
