<?php
namespace App\Logger;

/**
 * Class LoggerFormatter
 * @package App\Logger
 */
class LoggerFormatter
{
    /**
     * Colorize the string in the console
     * @param string $content
     * @param string $fgColor Foreground Color
     * @param string $bgColor Background Color
     * @return string
     */
    public static function colorizeString(
        string $content,
        string $fgColor = Colors::CONSOLE_FOREGROUND_COLOR_WHITE,
        string $bgColor = Colors::CONSOLE_BACKGROUND_COLOR_BLACK
    ): string {
        return "\e[" . $fgColor . ';' . $bgColor . 'm' . $content . "\e[0m";
    }

    /**
     * Formats the given JSON string
     * @param string $content
     * @param string $indentationStyle
     * @param int $indentationSize
     * @return string
     */
    public static function formatJsonString(
        string $content,
        string $indentationStyle = " ",
        int $indentationSize = 2
    ): string {
        return preg_replace(
            "/\t/i",
            str_repeat($indentationStyle, $indentationSize),
            $content
        );
    }
}
