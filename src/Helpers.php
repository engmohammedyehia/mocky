<?php
namespace App;

use App\MockServer\MockServer;
use DateTime;

/**
 * Class Helpers
 * @package App
 */
final class Helpers
{
    public static function bootMessage(MockServer $server)
    {
        $tl = html_entity_decode('┌', ENT_NOQUOTES, 'UTF-8');
        $tr = html_entity_decode('┐', ENT_NOQUOTES, 'UTF-8');
        $bl = html_entity_decode('└', ENT_NOQUOTES, 'UTF-8');
        $br = html_entity_decode('┘', ENT_NOQUOTES, 'UTF-8');
        $v = html_entity_decode('│', ENT_NOQUOTES, 'UTF-8');
        $h = html_entity_decode('─', ENT_NOQUOTES, 'UTF-8');

        $messages = [
            'welcomeMessage' => $v . str_repeat(' ', 2) . 'Mock Server started at '.(new DateTime())->format('H:i:s'),
            'serverVersion' => $v . str_repeat(' ', 2) . 'Server Version: '.$server->getVersion(),
            'ipAddress' => $v . str_repeat(' ', 2) . 'Server IP Address: '.$server->getServer()->host,
            'portNumber' => $v . str_repeat(' ', 2) . 'Port Number: '.$server->getServer()->port,
            'serverURL' => $v . str_repeat(' ', 2) .
            'Server URL: http://'.$server->getServer()->host.':'.$server->getServer()->port,
            'footerMessage' => $v . str_repeat(' ', 2) . 'Enjoy ;)'
        ];

        $padding = 1;

        $max = array_reduce(
            array_values($messages),
            function ($accumulator, $currentValue) {
                $length = mb_strlen($currentValue);
                if ($length > $accumulator) {
                    $accumulator = $length;
                }
                return $accumulator;
            },
            0
        );
        $max += 1;

        $topBorder = $tl. str_repeat($h, $max).$tr;
        $bottomBorder = $bl . str_repeat($h, $max)  . $br . "\n";
        $newLine = "\n". $v . str_repeat(' ', $max) . $v . "\n";

        $output = '';
        $output .= $topBorder;
        $output .= $newLine;
        foreach ($messages as $key => $message) {
            $output .= $message.str_repeat(' ', $max - mb_strlen($message) + $padding).$v."\n";
        }
        $output = trim($output, "\n");
        $output .= $newLine;
        $output .= $bottomBorder;
        return "\n".$output."\n\n";
    }
}
