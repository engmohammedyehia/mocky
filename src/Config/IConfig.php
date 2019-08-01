<?php
namespace App\Config;

/**
 * Interface IConfig
 * @package App\Config
 */
interface IConfig
{
    public function getIpAddress(): string;
    public function getPortNumber(): int;
    public function getConfigFilePath(): string;
    public function getConfigParser(): ConfigParser;
    public function getPrefix(): string;
    public function isLoggingEnabled(): bool;
}
