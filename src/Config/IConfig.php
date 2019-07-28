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
    function validateConfig(): bool;
}
