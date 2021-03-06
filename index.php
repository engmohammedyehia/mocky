<?php

require_once __DIR__.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use App\Logger\Logger;
use App\MockServer\Exceptions\InvalidVersionException;
use App\MockServer\Exceptions\MissingExtensionException;
use App\MockServer\MockServer;
use App\Config\Config;
use App\Response\Response;
use App\Router\Router;

$config = new Config(
    getenv('MOCK_SERVER_IP'),
    getenv('MOCK_SERVER_PORT'),
    getenv('MOCK_CONFIG_FILE'),
    [
        'prefix' => getenv('MOCK_SERVER_PREFIX'),
        'logging' => getenv('MOCK_SERVER_LOGGING')
    ]
);

try {
    $server = new MockServer(
        new Router(),
        new Response($config),
        new Logger()
    );
    $server->listen();
} catch (InvalidVersionException $e) {
    printf("Incompatible version of PHP: %s\n", $e->getMessage());
} catch (MissingExtensionException $e) {
    printf("Missing required extension: %s\n", $e->getMessage());
}

