<?php
namespace Test;

use App\Config\Config;
use App\Config\ConfigParser;
use App\Config\IConfig;
use App\Response\IResponse;
use App\Response\Response;
use DG\BypassFinals;
use PHPUnit\Framework\TestCase;

/**
 * Class ConfigParserTest
 * @package Test
 */
class ConfigParserTest extends TestCase
{
    /** @var IConfig */
    private $config;

    /** @var ConfigParser */
    private $configParser;

    /** @var IResponse */
    private $response;

    public function setUp(): void
    {
        BypassFinals::enable();
        $this->configParser = new ConfigParser(
            __DIR__.'/mock.config.yaml'
        );
        $this->config = new Config(
            '0.0.0.0',
            9501,
            __DIR__.'/mock.config.yaml',
            '',
            1
        );
        $this->response = new Response($this->config);
        parent::setUp();
    }

    public function testExtractResponseHeaders()
    {
        $this->response->setEndpoint('GET/employees');
        $this->response->setResponseType('Default');
        $headers = $this->configParser->extractResponseHeaders($this->response);
        $this->assertIsArray($headers);
        $this->assertArrayHasKey('Content-Type', $headers[0]);
    }
}
