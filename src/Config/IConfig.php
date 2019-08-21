<?php
namespace App\Config;

/**
 * Interface IConfig
 * @package App\Config
 */
interface IConfig
{
    /**
     * Returns the IP Address of the Server
     * @return string
     */
    public function getIpAddress(): string;

    /**
     * Returns the Port number of the Server
     * @return int
     */
    public function getPortNumber(): int;

    /**
     * Returns the end points configuration file
     * @return string
     */
    public function getConfigFilePath(): string;

    /**
     * Returns an instance of the Config Parser
     * @return ConfigParser
     */
    public function getConfigParser(): ConfigParser;

    /**
     * Returns the API prefix
     * @return string
     */
    public function getPrefix(): string;

    /**
     * Check if logging is enabled of not
     * @return bool
     */
    public function isLoggingEnabled(): bool;

    /**
     * Return a list of enabled loggers if logging is enabled
     * @return array
     */
    public function getRequestedLoggers(): array;
}
