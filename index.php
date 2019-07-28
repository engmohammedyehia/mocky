<?php

require_once __DIR__.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use App\MockServer\MockServer;
use App\Config\Config;
use App\Response\Response;

$config = new Config(
    '0.0.0.0',
    9501,
    __DIR__.'/mock.config.yaml'
);
$response = new Response($config);
$server = new MockServer($config, $response);
$server->setResponseType('UnAuthorized');
$server->listen();
