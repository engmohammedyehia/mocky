<?php
namespace App\Config;

use InvalidArgumentException;

/**
 * Class ConfigValidator
 * @package App\Config
 */
trait ConfigValidator
{
    /**
     * Validates the configuration
     * @return bool
     * @throws InvalidArgumentException
     */
    private function validateConfig(): bool
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
        if (!filter_var(
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
        if (!file_exists($this->getConfigFilePath()) ||
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

    /**
     * Check if the response header is a valid header
     * @param string $header
     * @return bool
     */
    private function validateHeader(string $header): bool
    {
        return in_array($header, StandardResponseHeaders::getStandardHeaders());
    }
}
