<?php
namespace App\MockData;

/**
 * Interface IMockData
 * @package App\MockData
 */
interface IMockData
{
    public function buildResponse(string $responseType): string;
}
