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
}
