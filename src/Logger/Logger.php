<?php
namespace App\Logger;

use App\Logger\Formatter\Colors;
use App\Logger\Formatter\LoggerFormatter;
use DateTime;

/**
 * Class Logger
 * @package App\Logger
 */
class Logger implements ILogger
{
    /** @inheritDoc */
    public function log(): void
    {
        $now = (new DateTime())->format('H:i:s');
        $newRequestText = LoggerFormatter::colorizeString(
            " ⇄ New request at $now ",
            Colors::CONSOLE_FOREGROUND_COLOR_BLACK,
            Colors::CONSOLE_BACKGROUND_COLOR_BLUE
        );
        printf("%s\n\n", $newRequestText);
    }
}
