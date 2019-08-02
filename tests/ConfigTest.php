<?php
namespace Tests;

use App\Config\Config;
use App\Config\ConfigParser;
use App\Config\IConfig;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /** @var IConfig */
    private $config;

    public function setUp(): void
    {
        parent::setUp();
        $this->config = new Config(
            '0.0.0.0',
            9501,
            __DIR__.'/mock.config.yaml',
            [
                'prefix' => '',
                'logging' => 1
            ]
        );
    }

    public function testCreateConfigParser()
    {
        $this->assertInstanceOf(
            ConfigParser::class,
            $this->config->getConfigParser()
        );
    }

    public function testGetPrefix()
    {
        $this->assertEquals('', $this->config->getPrefix());
    }

    public function testGetPortNumber()
    {
        $this->assertEquals(9501, $this->config->getPortNumber());
    }

    public function testIsLoggingEnabled()
    {
        $this->assertEquals(true, $this->config->isLoggingEnabled());
    }
}
