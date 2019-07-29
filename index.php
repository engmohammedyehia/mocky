<?php

require_once __DIR__.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use App\MockServer\MockServer;
use App\Config\Config;
use App\Response\Response;
use App\Router\Router;

$config = new Config(
    getenv('MOCK_SERVER_IP'),
    getenv('MOCK_SERVER_PORT'),
    getenv('MOCK_CONFIG_FILE'),
    getenv('MOCK_SERVER_PREFIX'),
    getenv('MOCK_SERVER_LOGGING')
);

$server = new MockServer(
    new Router(),
    new Response($config)
);
$server->listen();
