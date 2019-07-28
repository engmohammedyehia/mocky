<?php
namespace App\Config;

class StandardResponseHeaders
{
    private static $headers = [
        'Accept-Patch',
        'Accept-Ranges',
        'Age',
        'Allow',
        'Alt-Svc',
        'Cache-Control',
        'Connection',
        'Content-Disposition',
        'Content-Encoding',
        'Content-Language',
        'Content-Length',
        'Content-Location',
        'Content-Range',
        'Content-Type',
        'Date',
        'Delta-Base',
        'ETag',
        'Expires',
        'IM',
        'Last-Modified',
        'Link',
        'Location',
        'Pragma',
        'Proxy-Authenticate',
        'Public-Key-Pins',
        'Retry-After',
        'Server',
        'Set-Cookie',
        'Strict-Transport-Security',
        'Trailer',
        'Transfer-Encoding',
        'Tk',
        'Upgrade',
        'Vary',
        'Via',
        'Warning',
        'WWW-Authenticate',
    ];

    public static function getStandardHeaders()
    {
        return self::$headers;
    }
}

