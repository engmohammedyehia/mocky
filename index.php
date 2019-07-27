<?php

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;

$server = new Server("0.0.0.0", 9501);

$server->on("start", function ($server) {
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

$server->on("request", function (Request $request, Response $response) {
    $response->header("Content-Type", "application/json");
    $object = new stdClass();
    $object->name = 'Mohammed Abdoh';
    $object->age = 37;
    $body = json_encode($object, JSON_PRETTY_PRINT);
    $response->end("$body\n");
});

$server->start();
