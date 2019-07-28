<?php

require_once __DIR__.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use App\MockServer\MockServer;
use App\Config\Config;

$config = new Config(
    '0.0.0.0',
    9501,
    __DIR__.'/mock.config.yaml'
);
$server = new MockServer($config);
$server->listen();
