<?php

require_once __DIR__.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

use App\MockServer\MockServer;

$server = new MockServer('127.0.0.1', 9501);
$server->listen();
