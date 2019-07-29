<?php
namespace App\Config;

/**
 * Interface IConfig
 * @package App\Config
 */
interface IConfig
{
    function getIpAddress(): string;
    function getPortNumber(): int;
    function getConfigFilePath(): string;
    function getConfigParser(): ConfigParser;
    public function getPrefix(): string;
    public function getLogging(): bool;
}
